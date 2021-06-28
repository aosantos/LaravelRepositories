@extends('adminlte::page')

@section('content_header')
    <h3>
        Editar categoria:{{$category->title}}
    </h3>
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
                        <form action="{{route('categories.destroy',$category->id)}}" class="form-horizontal" method="POST">
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
