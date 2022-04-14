
<p>Dear, {{ $name }}</p>

<p>Your order № {{$order->id}}, for price {{$order->getFullSumm()}} was successfully created! </p>
<p>In your order:</p>

@foreach($order->products as $product)
    <p>{{$product->name}}</p>
    <br>
@endforeach


