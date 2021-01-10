<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // return Product::all(); //stacav datan

        $data = Product::all();

        return view('product', ['products' => $data]);
    }

    // Details
    public function detail($id)
    {

        $data = Product::find($id);
        return view('detail', ['product' => $data]);
    }
    //ADD TO CART
    function addToCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect('/');
        } else {
            return redirect('/gnaa');
        }
    }
    public static  function cartItem()
    {
        $userId = session()->get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }

    //Cart List
    public function cartList()
    {
        $userId = session()->get('user')['id'];
        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')   //Removi jamanak cart_id ogtagorcuma
            ->get();

        return view('cartlist', ['products' => $products]);
    }
    //DELETE Products in Cart
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    //ORDER
    function orderNow()
    {
        $userId=session()->get('user')['id'];
        $total= $products= DB::table('cart')
         ->join('products','cart.product_id','=','products.id')
         ->where('cart.user_id',$userId)
         ->sum('products.price');
 
         return view('ordernow',['total'=>$total]);
    }
    function orderPlace(Request $req)
    {
        $userId=session()->get('user')['id'];
         $allCart= Cart::where('user_id',$userId)->get();
         foreach($allCart as $cart)
         {
             $order= new Order;
             $order->product_id=$cart['product_id'];
             $order->user_id=$cart['user_id'];
             $order->status="pending";
             $order->payment_method=$req->payment;
             $order->payment_status="pending";
             $order->address=$req->address;
             $order->save();
             Cart::where('user_id',$userId)->delete(); 
         }
         $req->input();
         return redirect('/');
    }
    function myOrders()
    {
        $userId=session()->get('user')['id'];
        $orders= DB::table('orders')
         ->join('products','orders.product_id','=','products.id')
         ->where('orders.user_id',$userId)
         ->get();
 
         return view('myorders',['orders'=>$orders]);
    }
    //SEARCH
    function search(Request $req)
    {

        // return $req->input('query'); //query-n searchi inputi name-na

        $data = Product::where('name', 'like', '%' . $req->input('query') . '%')  //nayuma barov hamapatsxan beruma
            ->get();
        return view('search', ['products' => $data]);
    }


    //AdminPanel
    public function show(Request $req)
    {
        if ($req->session()->has('user')) {
            $data = Product::all();
            return view('adminPanel', ['products' => $data]);
        }
        return redirect('/login');


        // $data = Product::all();
        // if($req->session()->has('user'))
        // {
        //     return view('adminPanel',['products'=>$data]);
        // } else{
        //     return redirect('/login');
        // }
    }
    //ADD
    public function addData(Request $req)
    {

        $product = new Product;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->gallery = $req->gallery;
        $product->save();
        return redirect('adminPanel');
    }

    //Delete
    public function delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect('adminPanel');
    }
    //Edit
    public function edit($id)
    {

        $data = Product::find($id);
        return view('editPanel', ['data' => $data]);
    }
    //UPDATE
    public function update(Request $req)
    {

        $data = Product::find($req->id);
        $data->name = $req->name;
        $data->price = $req->price;
        $data->category = $req->category;
        $data->description = $req->description;
        $data->gallery = $req->gallery;
        $data->save();
        return redirect('/adminPanel');
    }
}




// public function index()
// {
//     // return Product::all(); //stacav datan

//     $data = Product::all();

//     return view('product', ['products' => $data]);
// }

// // Details
// public function detail($id)
// {

//     $data = Product::find($id);
//     return view('detail', ['product' => $data]);
// }
// //ADD TO CART
// function addToCart(Request $req)
// {
//     if ($req->session()->has('user')) {
//         $cart = new Cart;
//         $cart->user_id = $req->session()->get('user')['id'];
//         $cart->product_id = $req->product_id;
//         $cart->save();
//         return redirect('/');
//     } else {
//         return redirect('/gnaa');
//     }
// }
// public static  function cartItem()
// {
//     $userId = session()->get('user')['id'];
//     return Cart::where('user_id', $userId)->count();
// }

// //Cart List
// public function cartList()
// {
//     $userId = session()->get('user')['id'];
//     $products = DB::table('cart')
//         ->join('products', 'cart.product_id', '=', 'products.id')
//         ->where('cart.user_id', $userId)
//         ->select('products.*', 'cart.id as cart_id')   //Removi jamanak cart_id ogtagorcuma
//         ->get();

//     return view('cartlist', ['products' => $products]);
// }
// //DELETE Products in Cart
// function removeCart($id)
// {
//     Cart::destroy($id);
//     return redirect('cartlist');
// }
// //ORDER
// function orderNow()
// {
//     $userId=session()->get('user')['id'];
//     $total= $products= DB::table('cart')
//      ->join('products','cart.product_id','=','products.id')
//      ->where('cart.user_id',$userId)
//      ->sum('products.price');

//      return view('ordernow',['total'=>$total]);
// }
// function orderPlace(Request $req)
// {
//     $userId=session()->get('user')['id'];
//      $allCart= Cart::where('user_id',$userId)->get();
//      foreach($allCart as $cart)
//      {
//          $order= new Order;
//          $order->product_id=$cart['product_id'];
//          $order->user_id=$cart['user_id'];
//          $order->status="pending";
//          $order->payment_method=$req->payment;
//          $order->payment_status="pending";
//          $order->address=$req->address;
//          $order->save();
//          Cart::where('user_id',$userId)->delete(); 
//      }
//      $req->input();
//      return redirect('/');
// }
// function myOrders()
// {
//     $userId=session()->get('user')['id'];
//     $orders= DB::table('orders')
//      ->join('products','orders.product_id','=','products.id')
//      ->where('orders.user_id',$userId)
//      ->get();

//      return view('myorders',['orders'=>$orders]);
// }
// //SEARCH
// function search(Request $req)
// {

//     // return $req->input('query'); //query-n searchi inputi name-na

//     $data = Product::where('name', 'like', '%' . $req->input('query') . '%')  //nayuma barov hamapatsxan beruma
//         ->get();
//     return view('search', ['products' => $data]);
// }


// //AdminPanel
// public function show(Request $req)
// {
//     if ($req->session()->has('user')) {
//         $data = Product::all();
//         return view('adminPanel', ['products' => $data]);
//     }
//     return redirect('/login');


//     // $data = Product::all();
//     // if($req->session()->has('user'))
//     // {
//     //     return view('adminPanel',['products'=>$data]);
//     // } else{
//     //     return redirect('/login');
//     // }
// }
// //ADD
// public function addData(Request $req)
// {

//     $product = new Product;
//     $product->name = $req->name;
//     $product->price = $req->price;
//     $product->category = $req->category;
//     $product->description = $req->description;
//     $product->gallery = $req->gallery;
//     $product->save();
//     return redirect('adminPanel');
// }

// //Delete
// public function delete($id)
// {
//     $data = Product::find($id);
//     $data->delete();
//     return redirect('adminPanel');
// }
// //Edit
// public function edit($id)
// {

//     $data = Product::find($id);
//     return view('editPanel', ['data' => $data]);
// }
// //UPDATE
// public function update(Request $req)
// {

//     $data = Product::find($req->id);
//     $data->name = $req->name;
//     $data->price = $req->price;
//     $data->category = $req->category;
//     $data->description = $req->description;
//     $data->gallery = $req->gallery;
//     $data->save();
//     return redirect('/adminPanel');
// }