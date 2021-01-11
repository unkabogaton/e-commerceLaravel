@extends('voyager::master')
@section('content')

<div class="album py-4 bg-light">
    <div class="container">
        <br>
        <h3>Finished Transactions</h3>
        <br>
        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th class="text-center">Order#</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Payment</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Details</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delivered as $admin)
                <tr class="text-center">
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->status}}</td>
                    <td>P {{$admin->total_amount}}</td>
                    <td>{{$admin->payment_mode}}</td>
                    <td>{{$admin->created_at}}</td>
                    <td><a href="/admin/order/{{$admin->id}}" class="btn btn-info">More</a></td>
                    <td><a href="/prepare/{{$admin->id}}" class="btn btn-success">Prepare</a>&nbsp&nbsp<a href="/undo-finished/{{$admin->id}}" class="btn btn-danger">Undo</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection