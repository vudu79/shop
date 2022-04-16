@extends('layouts.main')
@section('content')

    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} {{ \App\Services\ConvertCurrency::getCurrencySimbol() }}</b></p>
    <img src="{{ Storage::url($product->image) }}">
    <p>{{ $product->description }}</p>


    @if($product->isAvailable())
        <form action="{{ route('basket.add', $product) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        </form>
    @else
        <br>
        <span>Товар не доступен</span>
        <br>
        <span>Сообщить мне о появлении товара:</span>

        <form action="{{ route('subscription', $product->id)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <x-error name="email"/>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    @endif




@endsection
