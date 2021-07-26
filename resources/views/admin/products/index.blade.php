@extends('adminlte::page')

@section('content_header')
    <h3>
        <a href="{{route('products.create')}}" class="btn btn-success">Adicionar</a>
        Produtos
    </h3>

    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}">Dashboard</a></li>
        /
        <li><a href="{{route('products.index')}}">Produtos</a></li>
    </ol>

@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="box box-success">
                            <div class="box-body">
                                @include('admin.includes.alerts')
                                <form action="{{route('products.search')}}" class="form form-inline" method="post">
                                    @csrf
                                    <select name="category" class="form-control">
                                        <option value="">Categoria</option>
                                        @foreach($categories as $id => $category)
                                            <option value="{{$id}}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="name" placeholder="Nome" class="form-control">
                                    <input type="text" name="price" placeholder="Preço" class="form-control">
                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Preço</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$product->name}}</th>
                                <td>{{$product->category->title}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <a href="{{route('products.edit',$product->id)}}" class="badge bg-yellow">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('products.show',$product->id)}}" class="badge bg-badge">
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
