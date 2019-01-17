<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Product;
use App\ProductIngredients;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function page()
    {
        $products = Product::with('ingredients')->paginate(15);

        return view('receipts', compact('products'));
    }
    public function index()
    {
        $products = Product::with('ingredients')->paginate(15);
        Log::info($products);
        return response()->json(['data' => $products]);
    }

    public function store(Request $request)
    {
        try {
            $product = new Product();
            $product->name = $request->post('name');
            $product->description = $request->post('description');
            $product->receipt = $request->post('receipt');
            $product->status = $request->has('status') ? $request->post('status') : Product::ACTIVE;
            $product->thumbnail = $request->post('thumbnail');

            $user = User::find($request->user()->id);
            $product->owner()->associate($user);

            $product->save();

            $insertedData = [];
            foreach ($request->post('ingredients') as $ingredient) {
                array_push($insertedData, [
                    'ingredient_id' => $ingredient['data']['id'],
                    'product_id' => $product->id,
                    'weight' => $ingredient['weight']
                ]);
            }

            DB::table('product_ingredients')->insert(
                $insertedData
            );

            return response()->json($product);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }


    }
}
