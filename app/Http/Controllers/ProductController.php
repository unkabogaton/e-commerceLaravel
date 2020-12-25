<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merienda;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $meriendas = Merienda::inRandomOrder()->get();

        return view('home')->with('meriendas', $meriendas);
    }

    public function show($id)
    {
        $merienda = Merienda::where('id', $id)->firstOrFail();
        return view('product')->with('merienda', $merienda);
    }

    public function addToCart(Request $request)
    {

        if (Auth::check()) {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->merienda_id = $request->merienda_id;
            $cart->quantity = $request->quantity;
            $result = DB::table('carts')
                ->where('user_id', '=', auth()->user()->id)
                ->where('merienda_id', '=', $request->merienda_id)
                ->first();
            if (!$result) {
                $cart->save();
            } else {
                $id = DB::table('carts')
                ->where('user_id', '=', auth()->user()->id)
                ->where('merienda_id', '=', $request->merienda_id)
                ->value('carts.id');
           
                $currentQty = DB::table('carts')
                ->where('user_id', '=', auth()->user()->id)
                ->where('merienda_id', '=', $request->merienda_id)
                ->value('quantity');
                $cart1 = Cart::find($id);
                $newQty = $request->quantity;
                $totalQty = $newQty + $currentQty;
                $cart1->quantity = $totalQty;
                $cart1->save();
              
            }

            return redirect('/home');
        } else {
            return redirect('/login');
        }
    }

    static function cartItem()
    {
        $userId = auth()->user()->id;
        return Cart::where('user_id', $userId)->sum('quantity');
    }

    public function cart()
    {
        $meriendas = Merienda::inRandomOrder()->get();
        $userId = auth()->user()->id;
        $cart_items = DB::table('carts')
            ->join('meriendas', 'carts.merienda_id', '=', 'meriendas.id')
            ->where('carts.user_id', $userId)
            ->select('*', 'carts.id as cart_id')
            ->get();

        return view('cart')->with('cart_items', $cart_items);
    }

    public function removeCartItem($id)
    {
        Cart::destroy($id);
        return redirect('cart');
    }

    public function orderNow()
    {
        $meriendas = Merienda::inRandomOrder()->get();
        $userId = auth()->user()->id;
        return $cart_items = DB::table('carts')
            ->join('meriendas', 'carts.merienda_id', '=', 'meriendas.id')
            ->where('carts.user_id', $userId)
            ->sum('meriendas.price');

        return view('cart')->with('cart_items', $cart_items);
    }
}
