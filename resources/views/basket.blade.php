@extends('layouts.main')

@section('content')
    <div class="starter-template">

        <div class="starter-template">
            @if(session()->has('addProduct'))
                <p class="alert alert-success">{{ session()->get('addProduct') }}</p>
            @elseif(session()->has('removeProduct'))
                <p class="alert alert-danger">{{ session()->get('removeProduct') }}</p>
            @endif


                <h1>Корзина</h1>
                    {{--            <p>Оформление заказа</p>--}}
                <div class="panel">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('product', $product->id) }}">
                                        <img height="56px"
                                             src="{{ Storage::url($product->image) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td><span class="badge">{{$product->pivot->count}}</span>
                                    <div class="btn-group form-inline">

                                        <form action="{{ route('basket.add', $product->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                        </form>
                                        <form action="{{ route('basket.remove',$product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><span
                                                    class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $product->price }} руб.</td>
                                <td>{{ $product->getPriceForCount() }} руб.</td>
                            </tr>
                        @endforeach
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{$order->getFullSumm()}} руб.</td>
                        </tr>
                        </tbody>
                    </table>


                    <div class="btn-group pull-right" role="group">
                        <a type="button" class="btn btn-success" href="{{ route('basket.place', $order) }}">Оформить
                            заказ</a>
                    </div>

            </div>
        </div>
@endsection
