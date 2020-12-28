@extends ('layout')
@section('content')

@foreach($order_details as $order)
<h2>Order #{{$order->order_id}}</h2>
@endforeach

<div class="row">
    <div class="col-md-6">
        <div class="card p-4 my-2 shadow">
            <h4 class="text-center">Ordered Foods</h4>
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center font-weight-light">Qty</th>
                        <th class="text-end font-weight-light">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eachOrder as $ordered)
                    <tr>
                        <td>
                            <a href="/detail/{{$ordered->merienda_id}}" class="h5 pusha">{{ $ordered->name }}</a>
                            <h6 class="font-weight-light"> P {{ $ordered->price }}</h6>
                        </td>
                        <td class="text-center">{{$ordered->quantity}}</td>
                        <td class="text-end font-weight-bold">P {{$ordered->priceQuantity}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @foreach($order_details as $order)
            <div class="mt-3 d-flex justify-content-between">
                <h5><span class="badge badge-success mb-2">{{$order->status}}</span></h5>
                <h5 class=""> Total amount: <strong>P {{$order->total_amount}}</strong> </h5>
            </div>

            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        @foreach($order_details as $order)
        <div class="card p-4 my-2 shadow">
            <h6>Created at: </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->created_at}}</h6>
            <br>
            <h6 class="text-muted">Deliver to</h6>
            <h6>Name: </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->full_name}}</h6>
            <h6>E-mail:</h6>
            <h6 class="font-weight-bold mt-n1">{{$order->email}}</h6>
            <h6>Mobile Number:</h6>
            <h6 class="font-weight-bold mt-n1">{{$order->contact_number}}</h6>
            <br>
            <h6 class="text-muted">Deliver at</h6>
            <h6>Address: </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->address}}</h6>
            <br>
            <h6 class="text-muted">Pay through</h6>
            <h6>Payment Method: </h6>
            <h6 class="font-weight-bold mt-n1">{{$order->payment_mode}}</h6>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <a href="/cancel-order/{{$order->order_id}}" class="btn btn-danger btn-sm d-flex d-inline-block mr-4">Cancel Order</a>
            <a href="/all-orders" class="btn btn-pusha btn-sm d-flex d-inline-block">Back</a>
        </div>
        @endforeach

    </div>


</div>

@endsection