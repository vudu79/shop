@extends('admin.layouts.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('products.update', $product) }}"
              @else
              action="{{ route('products.store') }}"
            @endisset
        >
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        <input autofocus type="text" class="form-control" name="code" id="code"
                               value="{{ old('code', isset($product) ? $product->code : null) }}">
                        <x-error name="code"/>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name', isset($product) ? $product->name : null) }}">
                        <x-error name="name"/>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        <select name="category_id" id="category_id" class="form-control">


                            @foreach($categories as $category)
                                <option
                                    @isset($product)
                                    {{$category->id == $product->category_id ? ' selected' : ''}}
                                    @endisset
                                    value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
								<textarea name="description" id="description" cols="72"
                                          rows="7">{{ old('description', isset($product) ? $product->description : null) }}</textarea>
                        <x-error name="description"/>
                    </div>
                </div>
                <br>

                @foreach(['new'=>'Новинка','hit'=>'Хит продаж','recommend'=>'Рекомендуем'] as $field => $title)

                    <div class="input-group row">
                        <label for="{{ $field }}" class="col-sm-2 col-form-label">{{ $title }}</label>
                        <div class="col-sm-6">
                            <input type="checkbox" name="{{ $field }}" id="{{ $field }}"
                                   @if(isset($product) && $product->$field === 1)
                                   checked="checked"
                                @endif
                            >
                            <x-error name="$field"/>
                        </div>
                    </div>
                    <br>

                @endforeach

                    <div class="input-group row">
                        <label for="count" class="col-sm-2 col-form-label">В наличии</label>
                        <div class="col-sm-6">
                            <input type="checkbox" name="count" id="count"
                                   @if(isset($product) && $product->count === 1)
                                   checked="checked"
                                @endif
                            >
                            <x-error name="$field"/>
                        </div>
                    </div>

                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" name="image" id="image">
                            <x-error name="image"/>
                        </label>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="price" id="price"
                               value="@isset($product){{ $product->price }} @else {{ old('price') }} @endisset">
                        <x-error name="price"/>
                    </div>
                </div>


                    <div class="input-group row my-3">
                        <label for="count" class="col-sm-2 col-form-label">В наличии: </label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="count" id="count"
                                   value="@isset($product){{ $product->count }} @else {{ old('count') }} @endisset">
                            <x-error name="count"/>
                        </div>
                    </div>


                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
