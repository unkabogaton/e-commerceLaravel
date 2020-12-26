@extends ('layout')
@section('content')
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $totalPrice = ProductController::totalPrice();
}

?>

<h1>
    Cart
</h1>

@foreach ($cart_items as $cart_item)
<div class="card p-3 my-2 shadow">
    <div class="row">
        <div class="col-md-2 col-5 text-center">
            <img src="{{asset('storage/'.$cart_item->image)}}" style="width: 115px;height:80px;">
        </div>
        <div class="col-md-10 col-7">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-12 my-auto">
                    <h4>{{ $cart_item->name }}</h4>
                    <p class="mt-n2"> P {{ $cart_item->price }} </p>
                </div>
                <div class="col-md-3 col-6 text-center form-inline">
                    <form action="/minusQty/{{$cart_item->cart_id}}" method="POST">
                        @csrf
                        <input type="hidden" min="1" name="quantity" value={{$cart_item->quantity}}>
                        <button type="submit" class="btn btn-pusha btn-sm">-</button>

                    </form>
                    <h6 class="mt-2 px-2">{{$cart_item->quantity}}</h6>
                    <form action="/addQty/{{$cart_item->cart_id}}" method="POST">
                        @csrf
                        <input type="hidden" min="1" name="quantity" value={{$cart_item->quantity}}>
                        <button type="submit" class="btn btn-pusha btn-sm">+</button>

                    </form>
                </div>
                <div class="col-md-2 col-6 text-center form-inline">
                    <h5 class="mt-2 ml-sm-0 ml-auto">P {{$cart_item->priceQuantity}}</h5>
                </div>
                <div class="col-md-2 col-sm-6 col-12 text-center form-inline">
                    <a class="btn btn-danger btn-sm ml-sm-0 ml-auto" href="/remove_cart_item/{{$cart_item->cart_id}}">Remove</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endforeach

<div class="row p-5">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-4">

    </div>
    <div class="col-lg-3 col-5 text-center">
        <h2>Total:</h2>
    </div>
    <div class="col-lg-2 col-7 text-md-center text-end">
        <h2 class=""> <strong>{{$totalPrice}}</strong> </h2>
    </div>
    <div class="col-lg-2 col-12 text-center mb-1 mt-lg-0 mt-3">
        <a href="/order" class="btn btn-pusha">Proceed to checkout</a>
    </div>

</div>


</div>



@endsection