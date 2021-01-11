@extends ('layout')
@section('content')

<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $order = ProductController::orderItem();
}

?>

<div>
    <br>
    <h1 class="mb-2"> Ongoing Orders </h1>
    <p><strong>Notice:</strong> Orders cannot be cancelled once they have the status "preparing". Thank you!</p>
    <br>
    @if($order!==0)

    <div class="card-columns">
        @foreach($orders as $order)
        <div class="card p-4">
            <h4 class="font-weight-bold">Order #{{$order->order_id}}</h4>
            <div class="form-inline">
                <h5 class="font-weight-bold"> P{{$order->total_amount}}</h5>
                <span class="badge badge-success mb-2 ml-auto">{{$order->status}}</span>
            </div>
            <h6 class="text-muted font-weight-light">Deliver to </h6>
            <h6 class="font-weight-bold mt-n1 mb-2">{{$order->full_name}}</h6>
            <h6 class="text-muted font-weight-light">Deliver at </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->address}}</h6>
            <h6 class="text-muted font-weight-light">Pay through </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->payment_mode}}</h6>
            <a class="btn btn-sm btn-pusha ml-auto" href="/order/{{$order->order_id}}">Order details</a>
        </div>
        @endforeach
    </div>

    @else
    <div class="text-center">
        <h4>Oops! Your do not have existing order.</h4>
        <a class="btn btn-pusha" href="/">Shop Now</a>
    </div>


    @endif

    <br>
    @if($done->count() != 0)
    <hr>
    <br>
    <h1 class="mb-3"> Finished Transactions</h1>
    <br>
    <div class="card-columns">
        @foreach($done as $order)
        <div class="card p-4">
            <h4 class="font-weight-bold">Order #{{$order->order_id}}</h4>
            <div class="form-inline">
                <h5 class="font-weight-bold"> P{{$order->total_amount}}</h5>
                <span class="badge badge-success mb-2 ml-auto">{{$order->status}}</span>
            </div>
            <h6 class="text-muted font-weight-light">Deliver to </h6>
            <h6 class="font-weight-bold mt-n1 mb-2">{{$order->full_name}}</h6>
            <h6 class="text-muted font-weight-light">Deliver at </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->address}}</h6>
            <h6 class="text-muted font-weight-light">Pay through </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->payment_mode}}</h6>
            <a class="btn btn-sm btn-pusha ml-auto" href="/order/{{$order->order_id}}">Order details</a>
        </div>
        @endforeach
    </div>

    @endif


</div>
@endsection