<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $categories = category::all();
        return view('admin.createPost', compact('categories'));
    }

    public function createPost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required'
        ]);

        $image = $this->uploadGambar($request->file('image'));

        auth()->user()->post()->create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category_id
        ]);

        return back()->with('sukses', 'Post Berhasil Ditambahkan!!');
    }

    private function uploadGambar($gambar, $gambarlama = null)
    {
        if ($gambarlama != null && $gambarlama != 'img_default.jpg') {
            File::delete('img/' . $gambarlama);
        }

        $namaBaru = uniqid('img_') . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('img', $namaBaru);
        return $namaBaru;
    }

    public function deletePost($id)
    {
        $post = post::findOrFail($id);
        $post->delete();
        return back()->with('sukses', 'Post Berhasil DiDelete!!');
    }
}
