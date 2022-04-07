@extends('leyauts.main')
@section('content')

    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="http://laravel-diplom-1.rdavydov.ru/storage/products/iphone_x.jpg">
    <p>{{ $product->description }}</p>
    <a class="btn btn-success" href="http://laravel-diplom-1.rdavydov.ru/basket/1/add">Добавить в корзину</a>

@endsection
