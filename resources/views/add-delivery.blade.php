@extends ('layout')
@section('content')
<h1 class="text-center">Add New Delivery Information</h1>

<div class="mx-auto">

    <div class="card p-5">

        <form class="needs-validation" method="POST" action="/add-delivery">
            @csrf
            <h4 class="mb-3">Deliver to</h4>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="full_name">First name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" name="email" value={{auth()->user()->email}} class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="contact_number">Contact_number</label>
                    <span class="form-inline">+63<input type="text" name="contact_number" class="ml-1 form-control w-75" id="contact_number" placeholder="9234567890" required></span>
                    <div class="invalid-feedback">
                        Please enter a valid contact number for shipping updates.
                    </div>
                </div>

            </div>



            <br>

            <h4 class="mb-3">Deliver at</h4>
            <div class="mb-3">
                <label for="address">Full Address</label>
                <input name="billing_address" type="text" class="form-control" id="address" placeholder="1234 Main St, Subdv., Town, Province" required>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
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


            <div class="d-flex justify-content-end"><a class="btn btn-danger mr-3" href="/order"><span><i class="fa fa-times"></i></span> Cancel</a><button type="submit" class="btn btn-pusha"><span><i class="fa fa-plus mr-1"></i></span> Add</button></div>

        </form>
    </div>
</div>

@endsection