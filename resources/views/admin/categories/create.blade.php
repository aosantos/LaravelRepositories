@extends('adminlte::page')

@section('content_header')
    <h3>
        Cadastrar nova categoria
    </h3>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    @include('admin.includes.alerts')

                    <form action="{{route('categories.store')}}" class="form-horizontal" method="POST">
                        @include('admin.categories._partials.form')
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
