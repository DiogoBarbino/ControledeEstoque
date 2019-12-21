@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gerenciador de Movimentações - Cadastrar</h1>
@stop

@section('content')
    <p>Cadastro de nova movimentação.</p>

<form action="{{route('transaction.store')}}" method="post">
@csrf
@method('POST')
<input type="hidden" name="user_id" value="1">
<div class="form-group">
  <label for="type">Tipo de movimentação</label>
  <select class="form-control" name="type" id="type">
    <option value="purchase" selected>Entrada</option>
    <option value="sale">Saída</option>
  </select>
</div>
<div class="form-group">
  <label for="product_id">Produto</label>
  <select class="form-control" name="product_id" id="product_id">
    @foreach($products as $product)
    <option value="{{$product->id}}">{{$product->description}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="price">Preço</label>
  <input type="text" class="form-control" name="price" id="price" value="25,00" readonly/>
</div>
<div class="form-group">
  <label for="quantity">Quantidade</label>
  <input type="number" class="form-control" name="quantity" id="quantity"/>
</div>

<div class="form-group">
  <label for="date">Data</label>
  <input type="date" class="form-control" name="date" id="date"/>
</div>
<button type="submit" class="btn btn-primary">Adicionar</button>
</form>
@stop

@section('css')
@stop

@section('js')
<script>
  $(function(){
    $('#product_id').on('change',function(){
        let product = $('#product_id').val();
        $.ajax({
            url: "http://localhost/controledeestoque/public/product/getprice/"+product,
            type: "get",
            dataType: 'json',
            success: function (response) {
              $('#price').val(""+response);
            }
        });        
    });
  });

</script>
@stop