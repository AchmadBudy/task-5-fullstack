<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    //

    public function getAllPost()
    {
        $data = Post::orderBy('id', 'desc')->paginate(10);
        return response()->json($data);
    }

    public function getAllPostById($id)
    {
        $data = Post::findOrFail($id);
        return response()->json($data);
    }

    public function insertPost(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required|unique:posts',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response(['error' => $validatedData->errors()], 401);
        }

        $image = $this->uploadGambar($request->file('image'));


        return response()->json(auth()->user()->post()->create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category_id
        ]));
    }

    public function updatePost($id, Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('posts')->ignore($request->id),
            ],
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response(['error' => $validatedData->errors()], 401);
        }

        $data = Post::findOrFail($id);

        if ($request->file('image')) {
            $image = $this->uploadGambar($request->file('image'), $data->image);
            return response()->json($data->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $image,
                'category_id' => $request->category_id
            ]));
        }
        return response()->json($data->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id
        ]));
    }

    public function deletePost($id)
    {
        $data = Post::findOrFail($id);
        File::delete('img/' . $data->image);
        return response()->json($data->delete());
    }

    private function uploadGambar($gambar, $gambarlama = null)
    {
        if ($gambarlama != null) {
            File::delete('img/' . $gambarlama);
        }

        $namaBaru = uniqid('img_') . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('img', $namaBaru);
        return $namaBaru;
    }
}
