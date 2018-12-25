<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Product;
use App\ProductIngredients;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('ingredients')->get()->all();
        return response()->json(['data' => $products]);
    }

    public function store(Request $request)
    {

//        $rules = [
//            'name' => 'required|max:255',
//            'description' => 'required|max:1024',
//            'status' => 'in:ACTIVE,DELETED',
//            'thumbnail' => 'max:524'
//        ];
//
//        $validator = $request->validate($rules);
//        Log::debug('validator', ['validator' => $validator]);

        $product = new Product();
        $product->name = $request->post('name');
        $product->description = $request->post('description');
        $product->receipt = $request->post('receipt');
        $product->status = $request->has('status') ? $request->post('status') : Product::ACTIVE;
        $product->thumbnail = $request->post('thumbnail');

        $user = User::find($request->user()->id);
        $product->owner()->associate($user);

        $savedProduct = $product->save();
        foreach ($request->post('ingredients') as $ingredient) {
//            $ingredientModel = new ProductIngredients();
//            $ingredientModel->product_id = $savedProduct['id'];
//            $ingredientModel->ingredient_id = $ingredient['data']['id'];
//            $ingredientModel->weight = $ingredient['weight'];
//            $ingredientModel->save();
//            $i = new Ingredient($ingredient['data']);
            $i = Ingredient::find($ingredient['data']['id'])->first();
            $product->ingredients()->attach($i, ['weight' => $ingredient['weight']]);
        }

//        return response()->json(['ok' => 'ok']);
        return response()->json($savedProduct);

    }
}
