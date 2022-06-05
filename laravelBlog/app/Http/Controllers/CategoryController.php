<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.createCategory');
    }
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        auth()->user()->category()->create([
            'name' => $request->name
        ]);

        return back()->with('sukses', 'Category berhasil ditambahkan!!');
    }
}
