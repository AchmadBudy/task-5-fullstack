@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>
    @endif
    @foreach ($posts as $post)


    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $post->title }} | {{ $post->category->name }}</div>

                <div class="card-body">
                    {{ $post->content }}
                    <div>
                        <a href="{{ route('detail_post',$post->id) }}">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row justify-content-center mt-5">

        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
