@extends('layouts.main')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary mt-3">
                <h3>Подтвердите заказ</h3>
                <p>Общая стоимоть заказа: {{ $order->calculateFullSumm() ?? '0 руб.' }}</p>
                <form method="post" action="{{ route('basket.confirm') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input autofocus name="name" type="text" value="{{ old('name') }}"
                                   class="form-control"
                                   placeholder="Имя">
                        </div>

                        <div class="form-group">
                            <input autofocus name="phone" type="text" value="{{ old('phone') }}"
                                   class="form-control"
                                   placeholder="Номер телефона">
                        </div>
                        <br>
                        @guest()
                            <div class="form-group">
                                <input autofocus name="email" type="text" value="{{ old('email') }}"
                                       class="form-control"
                                       placeholder="Email">
                            </div>
                        @endguest


                        <div class="form-group">
                            <button type="submit" class="btn btn-success ">
                                Подтвердить заказ
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
