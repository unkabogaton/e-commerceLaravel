@extends ('layout')
@section('content')
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $totalPrice = ProductController::totalPrice();
}

?>
<br>
<h1>
    Cart
</h1>
<br>
@if($totalPrice!==0)
@foreach ($cart_items as $cart_item)
<div class="card p-3 my-2 shadow">
    <div class="row">
        <div class="col-md-2 col-4 text-start align-middle">
            <img src="{{asset('storage/'.$cart_item->image)}}" class="img-fluid" style="width: 100% ;height:98px; object-fit: cover;">
        </div>
        <div class="col-md-10 col-8">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-12 pt-md-3 pt-0">
                    <div>
                        <h4 class="align-middle">{{ $cart_item->name }}</h4>
                        <p class="mt-n2 align-middle"> P {{ $cart_item->price }} </p>
                    </div>

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
                <div class="col-md-2 col-sm-6 col-12 text-center form-inline mt-sm-0 mt-2">
                    <a class="btn btn-danger btn-sm ml-sm-0 ml-auto" href="/remove_cart_item/{{$cart_item->cart_id}}"><span><i class="fa fa-trash"></i></span> Remove</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endforeach

<div class="row px-4 py-5">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-4">

    </div>
    <div class="col-lg-3 col-5 text-center">
        <h2>Total:</h2>
    </div>
    <div class="col-lg-2 col-7 text-md-center text-end">
        <h2 class=""> <strong>P {{$totalPrice}}</strong> </h2>
    </div>
    <div class="col-lg-2 col-12 text-end mb-1 mt-lg-0 mt-3">
        <a href="/order" class="btn btn-pusha">Checkout <span><i class="fa fa-arrow-right"></i></span></a>
    </div>

</div>


</div>

@else
<div class="text-center"><h4>Oops! Your cart is empty</h4>
<a class="btn btn-pusha" href="/"><span><i class="fa fa-shopping-bag"></i></span> Shop Now</a></div>


@endif



@endsection