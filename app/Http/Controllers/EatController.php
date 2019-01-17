<?php

namespace App\Http\Controllers;

use App\Eat;
use App\Exceptions\NotImplementedException;
use function GuzzleHttp\Psr7\_caseless_remove;
use Illuminate\Http\Request;

class EatController extends Controller
{
    public function index(Request $request)
    {
        try {
            $owner = !empty($request->user()->id) ? $request->user()->id : 1;
            $eats = Eat::where('owner_id', $owner)
                ->with('products')
                ->paginate(15);
            return response()->json($eats);
        } catch (NotImplementedException $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }

    }

    public function store(Request $request)
    {
        throw new NotImplementedException(__METHOD__);
    }
}
