@extends('adminlte::page')

@section('content_header')
    <h3>
        Detalhes da categoria:{{$category->title}}
    </h3>
    <ol class="breadcrumb">
        <li><a href="{{route('categories.index')}}">Categorias</a></li>
        /
        <li><a href="{{route('categories.show',$category->id)}}" class="active">Detalhes</a></li>
    </ol>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body">
                        <p><strong>ID:</strong>{{$category->id}}</p>
                        <p><strong>Título:</strong>{{$category->title}}</p>
                        <p><strong>URL:</strong>{{$category->url}}</p>
                        <p><strong>Descrição:</strong>{{$category->description}}</p>

                        <hr>
                        <form action="{{route('categories.destroy',$category->id)}}" class="form-horizontal"
                              method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
