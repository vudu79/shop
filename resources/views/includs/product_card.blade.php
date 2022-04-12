<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif
            @if($product->isRecommend())
                <span class="badge badge-warning">Рекомендуем</span>
            @endif
            @if($product->isHit())
                <span class="badge badge-danger">Хит</span>
            @endif

        </div>
        <img src="{{ Storage::url($product->image) }}" alt="iPhone X 64GB">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>Цена: {{ $product->price }} p.</p>
            <p>Категория: {{ isset($category) ? $category->name : $product->category->name }}</p>
            <p>В наличии: {{ $product->count }}</p>
            <p>
            <form action="{{ route('basket.add', $product) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary"
                        role="button"
                        role="button"9
                    {{ !$product->isAvailable() ? ' disabled' : '' }}
                >{{ $product->isAvailable() ? 'Добавить в корзину' : 'Нет в наличии' }}
                </button>
                <a href="{{ route('product', $product->id) }}" class="btn btn-default"
                   role="button">Подробнее</a>
            </form>
            </p>
        </div>
    </div>
</div>
