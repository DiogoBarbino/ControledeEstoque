@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Gerenciador de Estoque - Relatório</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="form-group">
          <label for="product_id">Produto</label>
          <select class="form-control" name="product_id" id="product_id">
            @foreach($products as $product)
            <option value="{{$product->id}}">{{$product->description}}</option>
            @endforeach
          </select>
        </div>
    </div>
    </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Entradas</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="inputChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-lg-6 col-12">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Saídas</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="outputChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

        <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Resultado</h3>
    
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <table id="tbTransactions" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td>Mês</td>
                                            <td>Entrada</td>
                                            <td>Saída</td>
                                            <td>Saldo do mês</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tbResults">
                                    </tbody>
                                </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@stop

@section('css')
@stop

@section('js')
<script>
    const updateGraph = (id, dataX, dataY) => {
        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#" + id).get(0).getContext('2d')

        var areaChartData = {
            labels: dataX,
            datasets: [
                {
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: dataY
                },
            ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })

    }

    const updateTable = (id,data) =>{
        var html = "";
        data.map(e=>{
            html += "<tr><td>"+e.month+"</td><td>"+e.input+"</td><td>"+e.output+"</td><td>"+e.result+"</td></tr>"
        });
        
        $('#'+id).html(html);
    }

    $(function () {

        $.ajax({
            url: "{{route('product.getdata')}}",
            type: "get",
            dataType: 'json',
            success: function (response) {
                updateTable("tbResults",response);
                var month = response.map(e => { return e.month });
                var input = response.map(e => { return e.input });
                var output = response.map(e => { return e.output });
                var result = response.map(e => { return e.result });
                updateGraph('inputChart', month, input);
                updateGraph('outputChart', month, output);
            }
        });

        $('#product_id').on('change',function(){
            let product = $('#product_id').val();

            $.ajax({
            url: "http://localhost/controledeestoque/public/product/getdata/"+product,
            type: "get",
            dataType: 'json',
            success: function (response) {
                updateTable("tbResults",response);
                var month = response.map(e => { return e.month });
                var input = response.map(e => { return e.input });
                var output = response.map(e => { return e.output });
                var result = response.map(e => { return e.result });
                updateGraph('inputChart', month, input);
                updateGraph('outputChart', month, output);
            }
        });




        });





    })

    
</script>
@stop