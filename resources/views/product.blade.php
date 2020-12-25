@extends ('layout')
@section('content')

<div> This is the details page </div>
<img src="{{asset('storage/'.$merienda->image)}}" style="width: 200px;">
<p>{{ $merienda->name }}</p>
<p> {{ $merienda->price }} </p>

<form action="/add_to_cart" method="POST">
@csrf
<input type="hidden" name="merienda_id" value={{$merienda->id}}>
<input type="number" min="1" step="1" name="quantity" value="1" class="form-control">

<button type="submit">Add to cart</button>

</form>

@endsection