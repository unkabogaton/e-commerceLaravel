<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merienda;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderedMerienda;
use App\Models\DeliveryInfo;
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

    static function orderItem()
    {
        $userId = auth()->user()->id;
        return Order::where('user_id', $userId)->where('status', '!=', 'pending')->count('id');
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
        $createOrder->delivery_info_id = $request->delivery_info_id;
        $createOrder->payment_mode = $request->payment_mode;
        $createOrder->status = 'pending';
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

        $order_details = DB::table('orders')
            ->join('delivery_info', 'orders.delivery_info_id', '=', 'delivery_info.id')
            ->where('orders.user_id', $userId)
            ->where('status', 'pending')
            ->select('*', 'orders.id as order_id')
            ->get();

        return view('order-summary', ['cart_items' => $cart_items, 'order_details' => $order_details]);
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
        $orders = DB::table('orders')
            ->join('delivery_info', 'orders.delivery_info_id', '=', 'delivery_info.id')
            ->where('orders.user_id', $userId)
            ->where('status', '!=', 'pending')
            ->select('*', 'orders.id as order_id')
            ->get();
        return view('all-orders')->with('orders', $orders);
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
            ->select('*', DB::raw('(meriendas.price * ordered_meriendas.quantity) as priceQuantity'))
            ->get();
        $order_details = DB::table('orders')
            ->join('delivery_info', 'orders.delivery_info_id', '=', 'delivery_info.id')
            ->where('orders.user_id', $userId)
            ->where('orders.id', $order_id)
            ->select('*', 'orders.id as order_id')
            ->get();

        return view('order-detail', ['eachOrder' => $eachOrder, 'order_details' => $order_details]);
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if ($order->status==='processing') {
            Order::destroy($id);
            OrderedMerienda::where('order_id', $id)->delete();
            return redirect('all-orders');
        } else {
            return redirect('all-orders');;
        }
    }

    public function showOrder($id)
    {
        $userId = auth()->user()->id;
        $info = Order::where('id', $id)->get();
        $deliveries = DeliveryInfo::where('user_id', $userId)->get();
        return view('edit-order', ['info' => $info, 'deliveries' => $deliveries]);
    }

    public function editOrder(Request $request, $id)
    {
        $editOrder = Order::find($id);
        $editOrder->user_id = auth()->user()->id;
        $editOrder->delivery_info_id = $request->delivery_info_id;;
        $editOrder->payment_mode = $request->payment_mode;
        $editOrder->save();
        return redirect('order-summary');
    }

    public function deliveries()
    {
        $userId = auth()->user()->id;
        $deliveries = DeliveryInfo::where('user_id', $userId)->get();
        return view('order')->with('deliveries', $deliveries);
    }

    public function delivery($id)
    {
        $delivery = DeliveryInfo::where('id', $id)->get();
        return view('edit-delivery')->with('delivery', $delivery);
    }

    public function editDelivery(Request $request, $id)
    {
        $editDelivery = DeliveryInfo::find($id);
        $editDelivery->user_id = auth()->user()->id;
        $editDelivery->full_name = $request->full_name;
        $editDelivery->contact_number = $request->contact_number;
        $editDelivery->address = $request->billing_address;
        $editDelivery->email = $request->email;
        $editDelivery->save();

        return redirect('order');
    }

    public function deleteDelivery($id)
    {
        DeliveryInfo::destroy($id);
        return redirect('order');
    }


    public function addDelivery(Request $request)
    {
        $addDelivery = new DeliveryInfo;
        $addDelivery->user_id = auth()->user()->id;
        $addDelivery->full_name = $request->full_name;
        $addDelivery->contact_number = $request->contact_number;
        $addDelivery->address = $request->billing_address;
        $addDelivery->email = $request->email;
        $addDelivery->save();

        return redirect('order');
    }

    public function search(Request $request)
    {
        $q = $request->search;
        $meriendas = DB::table('meriendas')
            ->where('name', 'like', '%' . $q . '%')
            ->orWhere('price', 'like', '%' . $q . '%')
            ->get();

        return view('home')->with('meriendas', $meriendas);
    }
}
