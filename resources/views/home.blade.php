 @extends ('layout')
 @section('content')

 <br>


 <div class="card-columns">

     @foreach ($meriendas as $merienda)
     <a href="/detail/{{$merienda->id}}">
         <div class="card mb-4 box-shadow rounded shadow">
             <div class="pt-3 pl-3 pr-3">
                 <img class="card-img-top img-fluid" src="{{asset('storage/'.$merienda->image)}}" style="width:100%; height:200px; object-fit: cover;" alt={{ $merienda->name }}>
             </div>
             <div class="card-body">
                 <h5 class="card-text font-weight-bold text-center" style="color:black;">{{ $merienda->name }}</h5>
                 <div class="card-text text-center mt-n2" style="color:black;">P {{ $merienda->price }}</div>
             </div>
         </div>
     </a>
     @endforeach

 </div>


 @endsection