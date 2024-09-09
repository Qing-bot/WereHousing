<?php
  
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function home_redirect()
    {
        return view('home');
    }
    public function addItem_redirect()
    {
        return view('addProduct');
        //Munculkan Auth Login
    }
    public function index_home(){
        $products = DB::table('products')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('user_id', '=', Auth::user()->id)
            ->select('products.*')
            ->simplePaginate(8); 
            $allTypes = DB::table('products')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->where('products.user_id', '=', Auth::user()->id)
            ->select('types.name')
            ->distinct()
            ->pluck('name');
        return view('main', compact('products', 'allTypes'));
    }
    
    public function viewPageSearch(Request $request)
{
    $search = $request->input('search');
    $type = $request->input('type');

    // Fetch all unique types
    $allTypes = DB::table('products')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->where('products.user_id', '=', Auth::user()->id)
        ->select('types.name')
        ->distinct()
        ->pluck('name');

    $query = DB::table('products')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('products.user_id', '=', Auth::user()->id);

    // Search bar
    if ($search) {
        $query->where('products.name', 'LIKE', "%{$search}%");
    }

    // Filter bar
    if ($type && $type !== 'All') {
        $query->join('types', 'products.type_id', '=', 'types.id')
              ->where('types.name', $type);
    }

    $products = $query->paginate(8);

    return view('main', compact('products', 'search', 'type', 'allTypes'));
}





    
    public function showProfile()
{
    $user = Auth::user();
    return view('profile', compact('user'));
}

    public function index_addItem(Request $request)
    {
        //home ke add item? idk
        return view('addItem');

    }
}