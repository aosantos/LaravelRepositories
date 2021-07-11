@extends('adminlte::page')

@section('content_header')
    <h3>
        Editar categoria:{{$category->title}}
    </h3>
    <ol class="breadcrumb">
        <li><a href="{{route('categories.index')}}">Categorias</a></li>/
        <li><a href="{{route('categories.edit',$category->id)}}" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    @include('admin.includes.alerts')

                    <form action="{{route('categories.update',$category->id)}}" class="form-horizontal" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        @include('admin.categories._partials.form')
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
