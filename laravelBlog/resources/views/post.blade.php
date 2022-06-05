@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><a href="{{ route('detail_post',$post->id) }}">{{ $post->title }}</a></div>

                <div class="card-body">
                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
