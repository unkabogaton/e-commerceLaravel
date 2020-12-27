@extends ('layout')
@section('content')
<h1 class="text-center">Delivery Information</h1>

<div class="mx-auto">

    <div class="card p-5">

        <form class="needs-validation" method="POST" action="/checkOut">
            @csrf
            <h4 class="mb-3">Deliver to</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input name="first_name" type="text" class="form-control" id="firstName" placeholder="" value="" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input name="last_name" type="text" class="form-control" id="lastName" placeholder="" value="" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" name="email" value={{auth()->user()->email}} class="form-control" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <br>

            <h4 class="mb-3">Deliver at</h4>
            <div class="mb-3">
                <label for="address">Full Address</label>
                <input name="billing_address" type="text" class="form-control" id="address" placeholder="1234 Main St, Subdv., Town, Province" required>
            </div>

            <!-- <div class="row">
            <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" required>
                    <option value="">Choose...</option>
                    <option>United States</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid country.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" id="state" required>
                    <option value="">Choose...</option>
                    <option>California</option>
                </select>
                <div class="invalid-feedback">
                    Please provide a valid state.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                    Zip code required.
                </div>
            </div>
        </div> -->

            <br>

            <h4 class="mb-3">Payment</h4>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio1" value="COD">
                        <label class="form-check-label" for="inlineRadio1">Cash on Delivery</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_mode" id="inlineRadio2" value="GCash">
                        <label class="form-check-label" for="inlineRadio2">GCash</label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="status" value="pending">
            <div class="d-flex justify-content-end"><button type="submit" class="btn btn-pusha ml-auto">Create Order</button></div>

        </form>
    </div>
</div>

@endsection