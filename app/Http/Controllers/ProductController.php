<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('ingredients')->get()->all();
        return response()->json(['data' => $products]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required|max:1024',
            'status' => 'in:ACTIVE,DELETED',
            'thumbnail' => 'max:524'
        ];

        $validator = $request->validate($rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator], 422);
        }

        $product = new Product();
        $product->name = $request->post('name');
        $product->description = $request->post('description');
        $product->receipt = $request->post('receipt');
        $product->status = $request->has('status') ? $request->post('status') : Product::ACTIVE;
        $product->thumbnail = $request->post('thumbnail');

        $user = User::find($request->user()->id);
        $product->owner()->associate($user);

        $savedProduct = $product->save();

        return response()->json($savedProduct);

    }
}
