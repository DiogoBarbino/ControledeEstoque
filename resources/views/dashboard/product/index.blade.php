@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Gerenciador de produtos</h1>
<a href="{{route('product.create')}}"><i class="fa fa-plus-circle"></i> Inserir Produto</a>
@stop

@section('content')
<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>SKU</th>
            <th>Descrição</th>
            <th>Estoque</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td scope="row">{{$product->sku}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@stop

@section('css')
@stop

@section('js')
@stop