@extends('leyauts.main')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card card-primary mt-3">

                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('admin.category.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input autofocus name="title" value="{{ old('title') }}" type="text"
                                   class="form-control"
                                   placeholder="Наименование категории">
                            @error('title')
                            <div class="text-danger">
                                Это обязательно к заполнению
                            </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="form-control btn btn-block btn-outline-secondary ">Добавить
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
