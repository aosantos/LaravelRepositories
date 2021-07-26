@extends('adminlte::page')

@section('content_header')
    <h3>
        Cadastrar novo produto
    </h3>
    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}">Dashboard</a></li>
        /
        <li><a href="{{route('products.index')}}">Produtos</a></li>
        /
        <li><a href="{{route('products.create')}}" class="active">Cadastrar</a></li>
    </ol>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    @include('admin.includes.alerts')

                        {{Form::open(['route' => 'products.store','class'=>'form'])}}
                        @include('admin.products._partials.form')
                        {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
@endsection
