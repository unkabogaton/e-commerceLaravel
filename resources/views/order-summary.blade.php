@extends ('layout')
@section('content')
<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $totalPrice= ProductController::totalPrice();
}

?>

<h1>
    This is the cart
</h1>


    @foreach ($cart_items as $cart_item)
    <div class="card">
        <img src="{{asset('storage/'.$cart_item->image)}}" style="width: 100px;">
        <a href="/detail/{{$cart_item->id}}">
            <p>{{ $cart_item->name }}</p>
        </a>
        <p> {{ $cart_item->price }} </p>
        <p> {{$cart_item->quantity}} </p>
        <p> Total: {{$cart_item->priceQuantity}} </p>

    </div>
    @endforeach

    <p>Order Total: {{$totalPrice}}</p>


    <form action="/place_order" method="POST">
    @csrf
    <button type="submit">Place Order</button>
</form>
    

    @endsection
