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
        return view('main')->with('products', $products);
    }
    
   public function viewPageSearch(Request $request)
{
    $search = $request->input('search');
    $type = $request->input('type');

    $query = DB::table('products')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('user_id','=',Auth::user()->id);
    //Search bar
    if ($search) {
        $query->where('name', 'LIKE', "%{$search}%");
    }

    //Filter Bar
    if ($type && $type !== 'All') {
        $query->where('type', $type);
    }

    $products = $query->paginate(8);

    return view('main', compact('products', 'search', 'type'));
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