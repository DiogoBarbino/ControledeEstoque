<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.home')->with(['products'=>$products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('dashboard.login');
    }
}
