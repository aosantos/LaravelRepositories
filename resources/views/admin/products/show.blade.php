@extends('adminlte::page')

@section('content_header')
    <h3>
        Detalhes do produto:{{$product->title}}
    </h3>
    <ol class="breadcrumb">
        <li><a href="{{route('products.index')}}">Categorias</a></li>/
        <li><a href="{{route('products.show',$product->id)}}" class="active">Detalhes</a></li>
    </ol>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-body">
                        <p><strong>ID:</strong>{{$product->id}}</p>
                        <p><strong>Nome:</strong>{{$product->name}}</p>
                        <p><strong>Categoria:</strong>{{$product->category->title}}</p>
                        <p><strong>Preço:</strong>{{$product->price}}</p>
                        <p><strong>Descrição:</strong>{{$product->description}}</p>

                        <hr>
                        <form action="{{route('products.destroy',$product->id)}}" class="form-horizontal" method="POST">
                           @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Deletar o produto:{{$product->name}}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
