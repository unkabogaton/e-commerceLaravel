@extends ('layout')
@section('content')
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $totalPrice = ProductController::totalPrice();
}

?>

<h1 class="text-center">Order Information</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card p-4 my-2 shadow">

            @foreach($order_details as $order)
            <h6 class="text-muted">Deliver to</h6>
            <h5>Name: </h5>
            <h5 class="font-weight-bold mt-n1">{{$order->billing_name}}</h5>
            <h5>E-mail:</h5>
            <h5 class="font-weight-bold mt-n1">{{$order->email}}</h5>
            <br>
            <h6 class="text-muted">Deliver at</h6>
            <h5>Address: </h5>
            <h5 class="font-weight-bold mt-n1">{{$order->billing_address}}</h5>
            <br>
            <h6 class="text-muted">Pay through</h6>
            <h5>Payment Method: </h5>
            <h5 class="font-weight-bold mt-n1">{{$order->payment_mode}}</h5>

            @endforeach

            <a href="" class="btn btn-pusha w-25 btn-sm ml-auto">Edit details</a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 my-2 shadow">
            <h4 class="text-center">Orders</h4>
            @foreach ($cart_items as $cart_item)
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <h5 class="align-middle">{{ $cart_item->name }}</h5>
                        <p class="mt-n2 align-middle"> P {{ $cart_item->price }} </p>
                    </div>

                </div>
                <div class="col-md-2 text-center form-inline">
                    <h6 class="px-2">X {{$cart_item->quantity}}</h6>
                </div>
                <div class="col-md-4 text-end form-inline">
                    <h5 class="ml-auto font-weight-bold">P {{$cart_item->priceQuantity}}</h5>
                </div>
            </div>
            <hr>
            @endforeach

            <div class="text-end mt-3">
                <h3 class=""> Total amount: <strong>P {{$totalPrice}}</strong> </h3>
            </div>
        </div>
    </div>
</div>

<form action="/place_order" method="POST" class="text-end mt-3">
    @csrf
    <button type="submit" class="btn btn-pusha btn-lg">Place Order</button>
</form>

@endsection