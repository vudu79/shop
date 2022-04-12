@extends('layouts.main')
@section('content')


    <h1>Все товары</h1>
    <div class="container d-flex justify-content-between">
        <div class="row">
            <div class="col-lg-12 d-flex j">
                <form method="GET" action="{{route("main")}}">
                    <div class="filters row">
                        <div class="col-sm-6 col-md-3">
                            <label for="price_from">Цена от
                                <input type="text" name="price_from" id="price_from" size="6"
                                       value="{{ request()->price_from}}">
                            </label>
                            <label for="price_to">до
                                <input type="text" name="price_to" id="price_to" size="6"
                                       value="{{ request()->price_to }}">
                            </label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <label for="hit">
                                <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif>
                                Хит
                            </label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <label for="new">
                                <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif>
                                Новинка
                            </label>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <label for="recommend">
                                <input type="checkbox" name="recommend" id="recommend"
                                       @if(request()->has('recommend')) checked @endif> Рекомендуем
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <button type="submit" class="btn btn-primary">Фильтр</button>
                            <a href="{{ route("main") }}" class="btn btn-warning">Сброс</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                @include('includs.product_card', ['product'=>$product])
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
