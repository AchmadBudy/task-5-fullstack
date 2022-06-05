<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        return response()->json(Category::all());
    }
    public function createCategory(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ]);

        if ($validatedData->fails()) {
            return response(['error' => $validatedData->errors()], 401);
        }

        return response()->json(auth()->user()->category()->create([
            'name' => $request->name
        ]));
    }
}
