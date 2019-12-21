@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciador de Estoque</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="col-xl-6 col-md-9 col-12">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>Produtos em Estoque {{$products->sum('quantity')}} / 350</h3>
            <p>{{floor(($products->sum('quantity')/350)*100)}}% do espaço disponível</p>
        </div>
        <div class="icon">
        </div>
        <a href="{{route('product.index')}}" class="small-box-footer">
        Ver detalhes
        <i class="fa fa-plus-circle"></i>
        </a>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script> console.log('Hi!'); </script>
@stop