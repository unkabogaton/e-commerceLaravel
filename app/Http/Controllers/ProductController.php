<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merienda;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderedMerienda;
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
                $cart1->quantity = $request->quantity + $currentQty;
                $cart1->save();
            }

            return redirect('/');
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
            ->select('*', 'carts.id as cart_id', DB::raw('(meriendas.price * carts.quantity) as priceQuantity'))
            ->get();

        return view('cart')->with('cart_items', $cart_items);
    }

    public function removeCartItem($id)
    {
        Cart::destroy($id);
        return redirect('cart');
    }

    static function totalPrice()
    {
        $meriendas = Merienda::inRandomOrder()->get();
        $userId = auth()->user()->id;
        return $cart_items = DB::table('carts')
            ->join('meriendas', 'carts.merienda_id', '=', 'meriendas.id')
            ->where('carts.user_id', $userId)
            ->sum(DB::raw('(meriendas.price * carts.quantity)'));
    }

    public function addQty(Request $request, $id)
    {
        $add_cart = Cart::find($id);
        $add_cart->quantity = $request->quantity + 1;
        $add_cart->save();
        return redirect('cart');
    }

    public function minusQty(Request $request, $id)
    {
        $currentQty = DB::table('carts')
            ->where('id', '=', $id)
            ->value('quantity');
        $minus_cart = Cart::find($id);
        if ($currentQty > 1) {
            $minus_cart->quantity = $request->quantity - 1;
            $minus_cart->save();
            return redirect('cart');
        } else {
            return redirect('cart');
        }
    }

    public function checkOut(Request $request)
    {
        $userId = auth()->user()->id;
        $orderExist = DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        $createOrder = new Order;
        $createOrder->user_id = auth()->user()->id;
        $createOrder->billing_name = $request->billing_name;
        $createOrder->billing_address = $request->billing_address;
        $createOrder->payment_mode = $request->payment_mode;
        $createOrder->status = $request->status;
        if (!$orderExist) {
            $createOrder->save();
        } else {
            Order::where('user_id', $userId)->where('status', "pending")->delete();
            $createOrder->save();
        }

        return redirect('order-summary');
    }

    public function orderSummary()
    {
        $userId = auth()->user()->id;
        $cart_items = DB::table('carts')
            ->join('meriendas', 'carts.merienda_id', '=', 'meriendas.id')
            ->where('carts.user_id', $userId)
            ->select('*', 'carts.id as cart_id', DB::raw('(meriendas.price * carts.quantity) as priceQuantity'))
            ->get();

        return view('order-summary')->with('cart_items', $cart_items);
    }

    public function placeOrder(Request $request)
    {
        $userId = auth()->user()->id;
        $allCart = Cart::where('user_id', $userId)->get();
        $order_id = DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->value('orders.id');

        $total_amount = DB::table('carts')
            ->join('meriendas', 'carts.merienda_id', '=', 'meriendas.id')
            ->where('carts.user_id', $userId)
            ->sum(DB::raw('(meriendas.price * carts.quantity)'));

        foreach ($allCart as $cart_item) {
            $ordered = new OrderedMerienda;
            $ordered->merienda_id = $cart_item['merienda_id'];
            $ordered->order_id = $order_id;
            $ordered->quantity = $cart_item['quantity'];
            $ordered->save();
            Cart::where('user_id', $userId)->delete();
        }
        $orderStats = Order::find($order_id);
        $orderStats->status = 'processing';
        $orderStats->total_amount = $total_amount;
        $orderStats->save();
        return redirect('/');
    }
    public function allOrders()
    {
        $userId = auth()->user()->id;
        // $eachOrder = DB::table('ordered_meriendas')
        //     ->join('orders', 'ordered_meriendas.order_id', '=', 'orders.id')
        //     ->join('meriendas', 'ordered_meriendas.merienda_id', '=', 'meriendas.id')
        //     ->where('orders.user_id', '=', $userId)
        //     ->select('*', 'orders.id as order_id', DB::raw('(meriendas.price * ordered_meriendas.quantity) as priceQuantity'))
        //     ->get()->groupBy('order_id');


        $orders = Order::where('user_id', $userId)->get();

        // $total = DB::table('ordered_meriendas')
        //     ->join('orders', 'ordered_meriendas.order_id', '=', 'orders.id')
        //     ->join('meriendas', 'ordered_meriendas.merienda_id', '=', 'meriendas.id')
        //     ->where('orders.user_id', $userId)
        //     ->select('orders.id as order_id', DB::raw('(meriendas.price * ordered_meriendas.quantity) as priceQuantity'))
        //     ->get();
        // $eachTotal = $total->groupBy('order_id');
        // $meriendas=OrderedMerienda::where()
        // return view('all-orders')->with('orders', $orders)->with('allOrders', $allOrders)->with('meriendas', $meriendas);

        // $orders = $eachOrder;
        // foreach ($orders as $order => $eachOrder) {
        //     echo "<h2> $order </h2>";
        //     echo "<h2>  </h2>";
        //     echo "<ul>";
        //     foreach ($eachOrder as $merienda) {
        //         echo "<li>" . $merienda->name. "</li>";
        //         echo "<li>" . $merienda->quantity. "</li>";

        //     }
        //     echo "</ul>";
        // }
        foreach ($orders as $order) {
            $order_id = $order->id;
            $ordered_items = DB::table('ordered_meriendas')
                ->join('orders', 'ordered_meriendas.order_id', '=', 'orders.id')
                ->join('meriendas', 'ordered_meriendas.merienda_id', '=', 'meriendas.id')
                ->where('orders.user_id', $userId)
                ->where('ordered_meriendas.order_id', $order_id)
                ->select('*', DB::raw('(meriendas.price * ordered_meriendas.quantity) as priceQuantity'))
                ->get();
            // foreach ($eachOrder as $item) {
            //     echo "<p> $item->name x $item->quantity</p>";
            //     echo "<p> $item->priceQuantity  </p>";
            // }
        }
        return view('all-orders',['orders'=> $orders,'ordered_items'=>$ordered_items]);
    }

    public function eachOrder($id)
    {
        $order_id = DB::table('orders')
            ->where('user_id', '=', auth()->user()->id)
            ->where('id', '=', $id)
            ->value('orders.id');
        $userId = auth()->user()->id;
        $eachOrder = DB::table('ordered_meriendas')
            ->join('orders', 'ordered_meriendas.order_id', '=', 'orders.id')
            ->join('meriendas', 'ordered_meriendas.merienda_id', '=', 'meriendas.id')
            ->where('orders.user_id', $userId)
            ->where('ordered_meriendas.order_id', $order_id)
            ->select('*')
            ->get();

        return $eachOrder;
    }
}
