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
    <h1> Orders </h1>

    @if($order!==0)

    <div class="card-columns">
        @foreach($orders as $order)
        <div class="card p-4 shadow">
            <h4 class="font-weight-bold">Order #{{$order->order_id}}</h4>
            <div class="form-inline">
                <h5 class="font-weight-bold"> P{{$order->total_amount}}</h5>
                <span class="badge badge-success mb-2 ml-auto">{{$order->status}}</span>
            </div>
            <h6 class="text-muted font-weight-light">Created at </h6>
            <h6 class="font-weight-bold mt-n1 mb-2">{{$order->created_at}}</h6>
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


</div>
@endsection