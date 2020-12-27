@extends ('layout')
@section('content')


<div class="card mb-4 box-shadow rounded shadow">
    <div class="row">
        <div class="col-md-6">
            <img class="card-img-left img-fluid my-image" src="{{asset('storage/'.$merienda->image)}}" alt={{ $merienda->name }}>
        </div>
        <div class="col-md-6 p-md-4 pr-md-5 pr-5 pt-4 pl-5 pb-4">
            <div class="d-flex justify-content-between">
                <h2 class="card-text font-weight-bold d-inline-block pusha">{{ $merienda->name }}</h5>
                    <h3 class="card-text d-inline-block mr-0">P {{ $merienda->price }} </h3>
            </div>


            <form action="/add_to_cart" method="POST" class="form-inline d-flex justify-content-between">
                @csrf
                <div class="d-inline-block">
                    <h5 class="d-inline-block">Quantity</h5>
                    <input type="number" min="1" step="1" name="quantity" value="1" class="w-25 d-inline-block form-control-sm form-control">
                </div>

                <input type="hidden" name="merienda_id" value={{$merienda->id}}>
                <button type="submit" class="btn btn-pusha badge-pill d-inline-block ml-auto">Add to cart</button>
            </form>
            <p class="mt-3 text-justify">{{ $merienda->details }}</p>
        </div>
    </div>
</div>
</div>

@endsection