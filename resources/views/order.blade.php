@extends ('layout')
@section('content')
<h1>Orders</h1>
    <form method="POST" action="/checkOut">
    @csrf
    <input type="text" name="billing_name" >
    <input type="text" name="billing_address">
    <select name="payment_mode" class="form-control" id="type">
    <option value="COD">Cash on Delivery</option>
    <option value="GCash">GCash</option>
    </select>
    <input type="hidden" name="status" value="pending">

    <button type="submit" class="btn btn-success">Create Order</button>
    </form>
@endsection

 