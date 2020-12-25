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

        <form action="/minusQty/{{$cart_item->cart_id}}" method="POST">
            @csrf
            <input type="hidden" min="1" name="quantity" value={{$cart_item->quantity}}>
            <button type="submit">minus</button>

        </form>

        <form action="/addQty/{{$cart_item->cart_id}}" method="POST">
            @csrf
            <input type="hidden" min="1" name="quantity" value={{$cart_item->quantity}}>
            <button type="submit">plus</button>

        </form>
        <a class="btn btn-danger" href="/remove_cart_item/{{$cart_item->cart_id}}">Remove from cart</a>
    </div>
    @endforeach

    <p>Order Total: {{$totalPrice}}</p>

    <a href="/order">Proceed to checkout</a>

    @endsection
