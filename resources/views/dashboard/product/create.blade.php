@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciador de produtos - Novo Produto</h1>
@stop

@section('content')
    <p>Criação de novo produto.</p>

<form action="{{route('product.store')}}" method="post">
@csrf
@method('POST')
<div class="form-group">
  <label for="sku">Código</label>
  <input type="text" class="form-control" name="sku" id="sku"/>
</div>
<div class="form-group">
  <label for="description">Descrição</label>
  <input type="text" class="form-control" name="description" id="description"/>
</div>
<div class="form-group">
  <label for="price">Preço</label>
  <input type="text" class="form-control" name="price" id="price"/>
</div>
<div class="form-group">
  <label for="quantity">Quantidade em estoque</label>
  <input type="text" class="form-control" name="quantity" id="quantity"/>
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop