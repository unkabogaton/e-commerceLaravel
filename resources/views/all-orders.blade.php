@extends ('layout')
@section('content')
<div>

<h1> is all your orders: </h1>

@foreach($orders as $order)
<div class="card">
    <h5>Order created at: {{$order->created_at}}</h5>
    <h5>status: {{$order->status}}</h5>
    <h4>Deliver to: {{$order->billing_name}}</h4>
    <h5>at {{$order->billing_address}}</h5>
    <h5>Total Amount: P{{$order->total_amount}}</h5>
    
    @foreach($ordered_items as $item)

        <a>{{$item->name}} X {{$item->quantity}}</a>
        <a>{{$item->priceQuantity}}</a>
    
    @endforeach

    </div>
@endforeach

</div>
@endsection