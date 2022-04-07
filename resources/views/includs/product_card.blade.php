<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="http://laravel-diplom-1.rdavydov.ru/storage/products/iphone_x.jpg" alt="iPhone X 64GB">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>Цена: {{ $product->price }} p.</p>
            <p>Категория: {{ $product->category->name }}</p>
            <p>
            <form action="{{ route('basket.add', $product) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary"
                   role="button">В корзину</button>
            </form>
                <a href="{{ route('product', $product->id) }}" class="btn btn-default"
                   role="button">Подробнее</a>
            </p>
        </div>
    </div>
</div>
