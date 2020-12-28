@extends ('head')
@section('content-1')
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $totalPrice = ProductController::totalPrice();
}

?>
<div class="album py-4">
    <div class="container">

        <h1 class="text-center">Order Information</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-4 my-2 shadow">

                    @foreach($order_details as $order)
                    <h6 class="text-muted">Deliver to</h6>
                    <h6>Name: </h6>
                    <h6 class="font-weight-bold mt-n1">{{$order->full_name}}</h6>
                    <h6>E-mail:</h6>
                    <h6 class="font-weight-bold mt-n1">{{$order->email}}</h6>
                    <h6>Mobile Number:</h6>
                    <h6 class="font-weight-bold mt-n1">+63{{$order->contact_number}}</h6>
                    <br>
                    <h6 class="text-muted">Deliver at</h6>
                    <h6>Address: </h6>
                    <h6 class="font-weight-bold mt-n1">{{$order->address}}</h6>
                    <br>
                    <h6 class="text-muted">Pay through</h6>
                    <h6>Payment Method: </h6>
                    <h6 class="font-weight-bold mt-n1">{{$order->payment_mode}}</h6>
                    <a href="order-info/{{$order->order_id}}" class="btn btn-info w-25 btn-sm ml-auto"><span><i class="fa fa-pencil-alt mr-1"></i></span> Edit details</a>
                    @endforeach

                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-4 my-2 shadow">
                    <h4 class="text-center">Order Contents</h4>
                    <br>
                    @foreach ($cart_items as $cart_item)
                    <div class="row mb-n3">
                        <div class="col-md-6">
                            <div>
                                <p class="align-middle">{{ $cart_item->name }}</p>
                                <p class="mt-n2 align-middle text-muted"> P {{ $cart_item->price }} </p>
                            </div>

                        </div>
                        <div class="col-md-2 mr-n3 text-center form-inline">
                            <h6>x {{$cart_item->quantity}}</h6>
                        </div>
                        <div class="col-md-4 text-end form-inline">
                            <h6 class="ml-auto font-weight-bold">P {{$cart_item->priceQuantity}}</h6>
                        </div>
                    </div>
                    <hr>
                    @endforeach

                    <div class="text-end mt-3">
                        <h5 class=""> Total amount: <strong>P {{$totalPrice}}</strong> </h5>
                    </div>
                </div>
            </div>
        </div>

        <form action="/place_order" method="POST" class="text-end mt-3">
            @csrf
            <button type="submit" class="btn btn-pusha shadow">Place Order <span><i class="fa fa-arrow-right ml-1"></i></span></button>
        </form>

    </div>
</div>

@endsection