@extends ('layout')
@section('content')

@foreach ($meriendas as $merienda)
<div class="card">
    <img src="{{asset('storage/'.$merienda->image)}}" style="width: 100px;">
    <a href="/detail/{{$merienda->id}}">
        <p>{{ $merienda->name }}</p>
    </a>
    <p> {{ $merienda->price }} </p>


</div>
@endforeach

@endsection