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
                    Tambah Category
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('post_category') }}">
                        <div class="form-group">
                          <label for="name">Nama Category</label>
                          <input type="text" class="form-control" id="name" name="name">
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
