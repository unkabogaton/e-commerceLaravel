<h1>
    This the cart
</h1>

<div class="container-fluid">
    @foreach ($cart_items as $cart_item)
    <div class="card">
        <img src="{{asset('storage/'.$cart_item->image)}}" style="width: 100px;">
        <a href="/detail/{{$cart_item->id}}">
            <p>{{ $cart_item->name }}</p>
        </a>
        <p> {{ $cart_item->price }} </p>
        <p> {{$cart_item->quantity}} </p>
        <a href="/remove_cart_item/{{$cart_item->cart_id}}">Remove to cart</a>
    </div>
    @endforeach

    <a href="order_now">Proceed to checkout</a>
</div>

