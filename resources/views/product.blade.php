@extends('layouts.main')
@section('content')

    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="{{ Storage::url($product->image) }}">
    <p>{{ $product->description }}</p>


    <form action="{{ route('basket.add', $product) }}" method="POST">
        @if($product->isAvailable())
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        @else
            Не доступен
        @endif
        @csrf
    </form>



{{--    <form action="{{ route('basket.add', $product) }}" method="post">--}}
{{--        @csrf--}}
{{--        <button type="submit" class="btn btn-success"--}}
{{--                role="button"--}}
{{--            {{ !$product->isAvailable() ? ' disabled' : '' }}--}}
{{--        >{{ $product->isAvailable() ? 'Добавить в корзину' : 'Нет в наличии' }}</button>--}}
{{--    </form>--}}


@endsection
