<?php

namespace App\Http\Controllers;

use App\Calories;
use App\Ingredient;
use App\User;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data'=>'data']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $calories = new Calories();
        $calories->calories = 10;
        $calories->proteins = 21.5;
        $calories->fats = 12.502;
        $calories->carbohydrates = 0.53;
        $calories->gi = 30;
        $calories->save();

        $ingredient = new Ingredient();
        $ingredient->name = $request->post('name');
        $ingredient->thumbnail = $request->post('thumbnail');
        $ingredient->description = $request->post('description');
        $ingredient->status = $request->post('status');

        $user = User::find($request->user()->id);
        $ingredient->owner()->associate($user);
        $ingredient->calories()->associate($calories);
        $ingredient->save();



//        $calories->ingredient()->save($ingredient);
        return response()->json([$ingredient, 'user' => $request->user()->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}