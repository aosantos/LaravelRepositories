@extends('adminlte::page')

@section('content_header')
    <h3>
        <a href="{{route('categories.create')}}" class="btn btn-success">Adicionar</a>
        Categorias
    </h3>

@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Categorias') }}</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Url</th>
                            <th scope="col">Descrição</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">1</th>
                                <th>{{$category->title}}</th>
                                <th>{{$category->url}}</th>
                                <th>{{$category->description}}</th>
                                <td>
                                    <a href="{{route('categories.edit',$category->id)}}" class="badge bg-yellow">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
