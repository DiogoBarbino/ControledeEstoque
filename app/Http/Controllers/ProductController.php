<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.product.index')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }


        /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getprice(Product $product)
    {
        return $product->price;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getData(int $product_id=null)
    {
        $product_id = (isset($product_id)?$product_id:null);
        $data = array();
        $data[] = $this->getValue(1, 2019,$product_id);
        $data[] = $this->getValue(2, 2019,$product_id);
        $data[] = $this->getValue(3, 2019,$product_id);
        $data[] = $this->getValue(4, 2019,$product_id);
        $data[] = $this->getValue(5, 2019,$product_id);
        $data[] = $this->getValue(6, 2019,$product_id);
        $data[] = $this->getValue(7, 2019,$product_id);
        $data[] = $this->getValue(8, 2019,$product_id);
        $data[] = $this->getValue(9, 2019,$product_id);
        $data[] = $this->getValue(10, 2019,$product_id);
        $data[] = $this->getValue(11, 2019,$product_id);
        $data[] = $this->getValue(12, 2019,$product_id);
        return $data;
    }

    private function getValue($month, $year, $product = null)
    {
        $month_name = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $lastday = date("t", mktime(0, 0, 0, $month, '01', $year));
        $data_inicio = mktime(0, 0, 0, $month, 1, $year);
        $data_fim = mktime(23, 59, 59, $month, $lastday, $year);

        $result = array();
        $result['month'] = $month_name[$month - 1];

        $init = date("Y-m-d", $data_inicio);
        $result['init'] = $init;
        $finish = date("Y-m-d", $data_fim);
        $result['end'] = $finish;

        if ($product) {
            $result['output'] = Transaction::where('type', 'sale')->where('product_id', $product)->whereBetween('date', array($init, $finish))->get()->sum('quantity');
            $result['input'] = Transaction::where('type', 'purchase')->where('product_id', $product)->whereBetween('date', array($init, $finish))->get()->sum('quantity');
            $result['result']=$result['input']-$result['output'];
        } else {
            $result['output'] = Transaction::where('type', 'sale')->whereBetween('date', array($init, $finish))->get()->sum('quantity');
            $result['input'] = Transaction::where('type', 'purchase')->whereBetween('date', array($init, $finish))->get()->sum('quantity');
            $result['result']=$result['input']-$result['output'];
        }

        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
