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
                    <div class="card-header">
                        <div class="box box-success">
                            <div class="box-body">
                                <form action="{{route('categories.search')}}" class="form form-inline" method="post">
                                    @csrf
                                    <input type="text" name="title" placeholder="Pesquisar" class="form-control" value="{{$data['title']?? ''}}">
                                    <input type="text" name="url" placeholder="Pesquisar" class="form-control" value="{{$data['url']?? ''}}" >
                                    <input type="text" name="description" placeholder="Pesquisar" class="form-control" value="{{$data['description']?? ''}}">
                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </form>

                                @if(isset($search))
                                    <p><strong>Resultados para:</strong>{{$search}}</p>
                                @endif
                            </div>

                        </div>
                    </div>
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
                                <td>
                                    <a href="{{route('categories.show',$category->id)}}" class="badge bg-badge">
                                        Detalhes
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
