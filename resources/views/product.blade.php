@extends ('layout')
@section('content')

<div> This is the details page </div>

<p>{{ $merienda->name }}</p>
<p> {{ $merienda->price }} </p>

<form action="/add_to_cart" method="POST">
@csrf
<input type="hidden" name="merienda_id" value={{$merienda->id}}>
<input type="number" min="1" step="1" name="quantity" value="1">

<button type="submit">Add to cart</button>

</form>

@endsection