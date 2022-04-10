@extends('layouts.main')

@section('content')

    <h1>
        {{ $category->name }} ({{ $category->products->count() }})
    </h1>
    <p>{{$category->description}}</p>

    <div class="row">
        @foreach($category->products as $product)
            @include('includs.product_card' , ['category'=>$category, 'product'=>$product])
        @endforeach
    </div>

@endsection
