@extends('layouts.main')
@section('content')


    <h1>Все товары</h1>

    <div class="row">
        @foreach($products as $product)
            @include('includs.product_card', ['product'=>$product])
        @endforeach
    </div>

@endsection
