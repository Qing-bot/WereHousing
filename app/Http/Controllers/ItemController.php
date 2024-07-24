<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\type;

class ItemController extends Controller


{

    

public function createProduct()
{
    //Ngambil type buat milih tipe nanti. pluck biar ambil string..? (masih perlu baca2 tapi gapake itu malahh error)
    $types = DB::table('products')->select('type')->distinct()->pluck('type');
    return view('additem', compact('types'));
}

public function insertProduct(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'nullable|string|max:255',
        'new_type' => 'nullable|string|max:255',
        'stock' => 'required|integer|min:1',
        'description' => 'nullable|string|max:30',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->new_type) {
        $type = $request->new_type;
    } else {
        $type = $request->type;
    }
    

    if (is_null($type)) {
        return redirect()->back()->withErrors(['type' => 'Type cannot be null.']);
    }

    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->hashName();
        $image = $image->storeAs('public/images', $imagePath);
    }

    $productID = DB::table('products')->insertGetId([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'type' => $type,
        'stock' => $request->stock,
        'description' => $request->description,
        'image' => $imagePath,
    ]);
    
    History::create([
        'user_id' => Auth::id(),
        'product_id' => $productID, 
        'action' => 'Produk Baru',
        'quantity' => $request->stock, 
        'details'=> 'Membuat Produk Baru Dengan Nama '. $request->name,
        'action_time' => now(),
    ]);

    return redirect()->route('index_home')->with('success', 'Item added successfully');
}

    public function viewProductDetail($id){
    $product = DB::table('products')->where('id', $id)->first();
    if (!$product) {
        return redirect()->route('index_home')->with('error', 'Product not found.');
    }
    return view('showProductDetail', compact('product'));
    }

    public function editProduct($id)
{
    $product = Product::findOrFail($id);
    $types = DB::table('products')->select('type')->distinct()->pluck('type');
    return view('editProduct', compact('product', 'types'));
}

public function updateProduct(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'nullable|string|max:255',
        'new_type' => 'nullable|string|max:255',
        'stock' => 'required|integer|min:1',
        'description' => 'nullable|string|max:30',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);
    $temp = Product::findOrFail($id);
    if ($request->new_type) {
        $type = $request->new_type;
    } else {
        $type = $request->type;
    }

    if (is_null($type)) {
        return redirect()->back()->withErrors(['type' => 'Type cannot be null.']);
    }

    $product->name = $request->input('name');
    $product->type = $type;
    $product->description = $request->input('description');
    $product->stock = $request->input('stock');

    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image) {
            Storage::delete('public/images/' . $product->image);
        }

        // Store new image
        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->storeAs('public/images', $imageName);
        $product->image = $imageName;
    }

    $product->save();
    $changes = [];
    if ($temp->name !== $product->name) {
        $changes[] = 'Nama diubah dari ' . $temp->name . ' menjadi ' . $product->name;
    }
    if ($temp->type !== $product->type) {
        $changes[] = 'Kategori diubah dari ' . $temp->type . ' menjadi ' . $product->type;
    }
    if ($temp->description !== $product->description) {
        $changes[] = 'Deskripsi diubah dari ' . $temp->description . ' menjadi ' . $product->description;
    }
    if ($temp->stock !== $product->stock) {
        $changes[] = 'Stok diubah dari ' . $temp->stock . ' menjadi ' . $product->stock;
    }
    if ($temp->image !== $product->image) {
        $changes[] = 'Gambar untuk  ' . $product->name . ' berhasil diubah';
    }

    $details = implode('; ', $changes);
    History::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'action' => 'Ubah Produk',
        'quantity' => $product->stock,
        'details' => $details,
        'action_time' => now(),
    ]);

    return redirect()->route('productDetail', ['id' => $product->id])->with('success', 'Product updated successfully');
}

    public function deleteProduct($id){
        $product = Product::find($id);

        if ($product) {
        // $productName = $product->name;
        History::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id, 
            'action' => 'Hapus Produk',
            'quantity' => 0,
            'details' => $product->name . ' telah dihapus',
            'action_time' => now(),
        ]);
        $product->delete();
    }

        return redirect()->route('index_home');
    }

    
    public function showCheckoutPage()
    {
        $products = DB::table('products')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('user_id','=',Auth::user()->id)
        ->select('products.*') 
        ->paginate(5);
        return view('checkout', compact('products'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
        ]);

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            if ($product->stock < $productData['quantity']) {
                return back()->withErrors(['message' => 'Not enough stock for ' . $product->name]);
            }
            $product->stock -= $productData['quantity'];
            $product->save();
            if($productData['quantity'] > 0){
                $changes[] = 'Stok ' . $product->name . ' dikurangi ' . $productData['quantity'];
            }
        }
        $details = implode('; ', $changes);
        History::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'action' => 'Pengurangan Stok',
        'quantity' => 0,
        'details' => $details,
        'action_time' => now(),
    ]);
        return redirect()->route('index_home')->with('success', 'Checkout successful!');
    }
    public function addStockPage()
    {
        $products = DB::table('products')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('user_id','=',Auth::user()->id)
        ->select('products.*') 
        ->paginate(5);
        return view('addStock', compact('products'));
    }

    public function processAddStock(Request $request)
    {
        
        $changes = [];
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            $product->stock += $productData['quantity'];
            $product->save();
            if($productData['quantity'] > 0){
                $changes[] = 'Stok ' . $product->name . ' ditambahkan ' . $productData['quantity'];
            }
        }
        $details = implode('; ', $changes);
        History::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'action' => 'Penambahan Stok',
        'quantity' => 0,
        'details' => $details,
        'action_time' => now(),
    ]);
        return redirect()->route('index_home')->with('success', 'Checkout completed successfully!');
    }
}
