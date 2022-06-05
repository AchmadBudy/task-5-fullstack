@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('sukses'))
            <div class="alert alert-success" role="alert">
                {{session('sukses')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Tambah Post
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('post_post') }}" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="title">Nama Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content"rows="3">{{old('content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="categories">Select Category</label>
                            <select class="form-control" id="categories" name="category_id">
                                @foreach ($categories as $category)
                                    
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="formFileLg" class="form-label">Select Gambar</label>
                            <input class="form-control form-control-lg" id="formFileLg" type="file" name="image">
                          </div>
                        @csrf
                        <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
