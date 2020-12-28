@extends ('layout')
@section('content')
<h1 class="text-center">Edit Delivery Information</h1>

@foreach($info as $info)
<form action="/edit-order/{{$info->id}}" method="POST" class="needs-validation">
    @csrf
    <div class="card p-4 text-center">
        <h4>Select Delivery Information</h4>

        <table class="table table-hover table-responsive-md mx-auto mt-1">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center font-weight-light">Full Name</th>
                    <th class="text-center font-weight-light">E-mail</th>
                    <th class="text-center font-weight-light">Mobile No.</th>
                    <th class="text-center font-weight-light">Delivery Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $delivery)
                <tr>
                    <td class="text-center">
                        @if($info->delivery_info_id === $delivery->id)
                        <input type="radio" name="delivery_info_id" value="{{$delivery->id}}" required checked>
                        @else
                        <input type="radio" name="delivery_info_id" value="{{$delivery->id}}" required>
                        @endif
                    </td>
                    <td class="text-center">{{$delivery->full_name}}</td>
                    <td class="text-center">{{$delivery->email}}</td>
                    <td class="text-center">{{$delivery->contact_number}}</td>
                    <td class="text-center">{{$delivery->address}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-md-4 d-flex justify-content-center mt-1 mx-auto">
            <a href="/add-delivery" class="btn btn-success btn-sm">Add Delivery Information</a>
        </div>

        <br>

        <h4 class="mb-3">Select Payment</h4>

        <div class="row">
            <div class="col-md-12 mb-3">
                @if($info->payment_mode === 'COD')
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio1" value="COD" required checked>
                    <label class="form-check-label" for="inlineRadio1">Cash on Delivery</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio2" value="GCash" required>
                    <label class="form-check-label" for="inlineRadio2">GCash</label>
                </div>
                @else
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio1" value="COD" required>
                    <label class="form-check-label" for="inlineRadio1">Cash on Delivery</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio2" value="GCash" required checked>
                    <label class="form-check-label" for="inlineRadio2">GCash</label>
                </div>
                @endif
                <div class="invalid-feedback">
                    Please select payment method.
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-pusha ml-auto">Save Order</button></div>
</form>
@endforeach

@endsection