<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function viewCheckout()
{
    // Retrieve checkout items and calculate total price
    $checkoutItems = session('checkoutItems', []);
    $totalPrice = array_reduce($checkoutItems, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // Pass products for the view
    $products = Product::all();
    return view('checkout', compact('checkoutItems', 'totalPrice', 'products'));
}

public function addToCheckout(Request $request, $id)
{
    // Retrieve or create a checkout session
    $checkoutItems = session('checkoutItems', []);
    
    // Find the product
    $product = Product::findOrFail($id);
    
    // Check if the product is already in the checkout
    if (isset($checkoutItems[$id])) {
        $checkoutItems[$id]['quantity'] += $request->input('quantity');
    } else {
        $checkoutItems[$id] = [
            'product' => $product,
            'quantity' => $request->input('quantity'),
            'price' => $product->sell_price
        ];
    }

    // Save the updated checkout items to the session
    session(['checkoutItems' => $checkoutItems]);
    
    return redirect()->route('viewCheckout');
}

public function updateQuantity(Request $request, $productId)
{
    // Find the product
    $product = Product::findOrFail($productId);

    // Get the current checkout item
    $checkoutItem = session('checkoutItems')[$productId] ?? null;

    // Check if the checkout item exists
    if (!$checkoutItem) {
        return back()->withErrors(['message' => 'Item not found in checkout']);
    }

    // Determine the action (increase or decrease)
    $action = $request->input('action');
    $newQuantity = $checkoutItem['quantity'];

    if ($action === 'increase') {
        $newQuantity++;
    } elseif ($action === 'decrease') {
        $newQuantity--;
    }

    // Validate the new quantity
    if ($newQuantity <= 0) {
        // Remove the item if the quantity is zero or less
        unset(session('checkoutItems')[$productId]);
        return back()->with('message', 'Item removed from checkout');
    }

    if ($product->stock < $newQuantity) {
        return back()->withErrors(['message' => 'Not enough stock for ' . $product->name]);
    }

    // Update the quantity in the session
    session()->put("checkoutItems.$productId.quantity", $newQuantity);

    // Recalculate total price (optional, if needed)
    $this->recalculateTotalPrice();

    return back()->with('message', 'Quantity updated successfully');
}

private function recalculateTotalPrice()
{
    $checkoutItems = session('checkoutItems', []);
    $totalPrice = 0;

    foreach ($checkoutItems as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    session()->put('totalPrice', $totalPrice);
}

public function removeItem(Request $request, $id)
{
    $checkoutItems = session('checkoutItems', []);
    
    if (isset($checkoutItems[$id])) {
        unset($checkoutItems[$id]);
        session(['checkoutItems' => $checkoutItems]);
    }

    return redirect()->route('viewCheckout');
}

public function processCheckout(Request $request)
{
    $checkoutItems = session('checkoutItems', []);
    $userId = Auth::id();
    $totalPrice = array_reduce($checkoutItems, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // Create the checkout record
    $checkoutId = DB::table('checkouts')->insertGetId([
        'user_id' => $userId,
        'total_price' => $totalPrice,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Create records for each item
    foreach ($checkoutItems as $item) {
        DB::table('checkout_items')->insert([
            'checkout_id' => $checkoutId,
            'product_id' => $item['product']->id,
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);

        // Update product stock
        Product::where('id', $item['product']->id)
            ->decrement('stock', $item['quantity']);
    }

    // Clear the checkout session
    session()->forget('checkoutItems');

    return redirect()->route('index_home')->with('success', 'Checkout processed successfully.');
}

}
