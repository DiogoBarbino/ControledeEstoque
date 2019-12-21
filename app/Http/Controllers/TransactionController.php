<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderby('date','Desc')->get();
        $products = Product::all();

        return view('dashboard.transaction.index')
        ->with([
            'products'=>$products,
            'transactions'=>$transactions,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('dashboard.transaction.create')->with(['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Transaction::create($request->all());
        $product = Product::where('id',$request->product_id)->first();
        if($request->type=="sale"){
            $product->quantity -= $request->quantity;
            $product->save();
        }else if($request->type=="purchase"){
            $product->quantity += $request->quantity;
            $product->save();
        }else{
            echo "Erro ao alterar<br>";
            die();
        }
        return redirect(route('transaction.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function resume()
    {
        $transactions = Transaction::orderby('date','Desc')->get();
        $products = Product::all();

        return view('dashboard.transaction.resume')
        ->with([
            'products'=>$products,
            'transactions'=>$transactions,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
