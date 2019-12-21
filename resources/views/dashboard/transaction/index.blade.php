@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Gerenciador de movimentações</h1>
@stop

@section('content')
<a href="{{route('transaction.create')}}">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Adicionar</h3>
                <p>Inserir Nova Movimentação</p>
            </div>
            <div class="icon">
                <ion-icon name="cube"></ion-icon>
            </div>
        </div>
    </div>
</a>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Histórico de movimentação</h3>
    </div>
    <div class="card-body">
        <table id="tbTransactions" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->date}}</td>
                    <td>{{($transaction->type=="sale")?"Saída":"Entrada"}}</td>
                    <td>
                        @php
                        $temp = App\Product::where('id',$transaction->product_id)->first();
                        echo $temp->description;
                        @endphp
                    </td>
                    <td>{{$transaction->quantity}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    $(function () {
        $('#tbTransactions').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
        });
    });
</script>
@stop