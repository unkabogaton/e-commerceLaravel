@extends('voyager::master')
@section('content')

<?php

use App\Http\Controllers\ProductController;

$proc = ProductController::proc();
$prep = ProductController::prep();
$ship = ProductController::ship();

?>

<div class="album py-4 bg-light">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="/admin/processing" role="tab" aria-controls="home" aria-selected="false">Processing <span class="badge badge-success ml-1">{{$proc}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/preparing" role="tab" aria-controls="profile" aria-selected="false">Preparing <span class="badge badge-success ml-1">{{$prep}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/admin/shipping" style="background: white;" role="tab" aria-controls="contact" aria-selected="true">Shipping <span class="badge badge-success ml-1">{{$ship}}</span></a>
            </li>
        </ul>
        <h3>Shipping</h3>
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
                @foreach($shipping as $admin)
                <tr class="text-center">
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->status}}</td>
                    <td>P {{$admin->total_amount}}</td>
                    <td>{{$admin->payment_mode}}</td>
                    <td>{{$admin->created_at}}</td>
                    <td><a href="/admin/order/{{$admin->id}}" class="btn btn-info">More</a></td>
                    <td><a href="/finished/{{$admin->id}}" class="btn btn-success">Finished</a>&nbsp&nbsp<a href="/undo-ship/{{$admin->id}}" class="btn btn-danger">Undo</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($shipping->count()==0)
        <p>No shipping product right now.</p>
        @endif
    </div>
</div>
@endsection