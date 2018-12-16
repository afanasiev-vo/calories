<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('ingredients')->get()->all();
        return response()->json(['data'=>$products]);
    }

    public function store(Request $request)
    {
        $product = new Product();

    }
}
