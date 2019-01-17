<?php

namespace App\Http\Controllers;

use App\Calories;
use App\Ingredient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IngredientController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::debug('Ingredient@index');
        // $ingredients = Ingredient::with('products')->paginate(Ingredient::PER_PAGE);
        $system = User::where('name', 'SYSTEM')->first();
        $ingredients = Ingredient::whereIn('owner_id', [$system->id, $request->user()->id])
            ->orderBy('name', 'asc')
            ->paginate(Ingredient::PER_PAGE);
        return response()->json($ingredients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ingredient = new Ingredient();
        $ingredient->name = $request->post('name');
        $ingredient->thumbnail = $request->post('thumbnail');
        $ingredient->description = $request->post('description');
        $ingredient->state = $request->post('state');
        $ingredient->status = Ingredient::ACTIVE;
        $ingredient->calories = $request->post('calories');
        $ingredient->proteins = $request->post('proteins');
        $ingredient->fats = $request->post('fats');
        $ingredient->carbohydrates = $request->post('carbohydrates');
        $ingredient->gi = $request->post('gi');

        $user = User::find($request->user()->id);
        $ingredient->owner()->associate($user);
        $ingredient->save();


        return response()->json($ingredient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Log::info('destroy ingredient', ['Id' => $id]);
            $ingredient = Ingredient::find($id);
            $ingredient->delete();
//            Ingredient::destroy($id);
            return response()->json(['ok' => 'ok']);
        } catch (\Exception $exception) {
            Log::error('[INGREDIENT DESTROY]', [$exception]);
            return response()->json(['message' => $exception->getMessage()], 500);
        }

    }
}
