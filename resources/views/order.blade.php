<div>
<div class="container-fluid">
<h1>Orders</h1>
    <form method="POST" action="/order">
    @csrf
    <button type="submit">Create Order</button>
    </form>
        @foreach ($orders as $order)
        <div class="card">

                <p>{{ $order->id }}</p>

        </div>
        @endforeach
    </div>
</div>