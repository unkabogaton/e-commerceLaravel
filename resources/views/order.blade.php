@extends ('layout')
@section('content')
<h1 class="text-center">Delivery Information</h1>

<form action="/check-out" method="POST" class="needs-validation">
    <div class="card p-4 text-center">
        @csrf
        <h4>Select Delivery Information</h4>

        <table class="table table-hover table-responsive-md mx-auto mt-1">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center font-weight-light">Full Name</th>
                    <th class="text-center font-weight-light">E-mail</th>
                    <th class="text-center font-weight-light">Mobile No.</th>
                    <th class="text-center font-weight-light">Delivery Address</th>
                    <th class="text-center font-weight-light">Edit</th>
                    <th class="text-center font-weight-light">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($deliveries as $delivery)
                <tr>
                    <td class="text-center"><input type="radio" name="delivery_info_id" value="{{$delivery->id}}" required></td>
                    <td class="text-center">{{$delivery->full_name}}</td>
                    <td class="text-center">{{$delivery->email}}</td>
                    <td class="text-center">{{$delivery->contact_number}}</td>
                    <td class="text-center">{{$delivery->address}}</td>
                    <td class="text-center">
                        <a href="delivery/{{$delivery->id}}" class="btn btn-sm btn-info"><span><i class="fa fa-pencil-alt mr-1"></i></span> Edit</a>
                    </td>
                    <td class="text-center">
                        <a href="delete-delivery/{{$delivery->id}}" class="btn btn-sm btn-danger"><span><i class="fa fa-trash mr-1"></i></span> Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($deliveries->count()==0)
        <p>You do not have existing record of your delivery information, create then select one to proceed creating your order.</p>
        @endif

        <div class="col-md-4 d-flex justify-content-center mt-1 mx-auto">
            <a href="/add-delivery" class="btn btn-success btn-sm"><span><i class="fa fa-plus"></i></span> Add Delivery Information</a>
        </div>

        <input type="hidden" name="status" value="pending">

        <input type="hidden" name="total_amount" value="0">

        <br>

        <h4 class="mb-3">Select Payment</h4>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio1" value="COD" required>
                    <label class="form-check-label" for="inlineRadio1">Cash on Delivery</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio2" value="GCash" required>
                    <label class="form-check-label" for="inlineRadio2">GCash</label>
                </div>
                <div class="invalid-feedback">
                    Please select payment method.
                </div>
            </div>
        </div>
    </div>
    <br>
    @if($deliveries->count()==0)
    <div class="d-flex justify-content-end"><button class="btn btn-pusha disabled ml-auto">Create Order <span class="ml-1"><i class="fa fa-arrow-right"></i></span></button></div>
    @else
    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-pusha ml-auto">Create Order <span class="ml-1"><i class="fa fa-arrow-right"></i></span></button></div>
    @endif
</form>



@endsection