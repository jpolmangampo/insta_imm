@extends('layouts.app')

@section('title', 'Category {{ $category->name }}')

@section('content')


    <div style="margin-top: 100px">
        <div class="text-center mb-3">
            <h3 class="text-secondary">Category: {{ $category->name }}</h3>
        </div>
        {{-- @if ($category_posts->isNotEmpty()) --}}
        <div class="row">
            @forelse ($category_posts as $category_post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('post.show', $category_post->post->id) }}"><img src="{{ $category_post->post->image }}"
                            alt="post id {{ $category_post->post->id }}" class="grid-img"></a>
                </div>
            @empty
                <h3 class="text-muted text-center">No Posts Yet</h3>
            @endforelse
        </div>

        {{-- @endif --}}
    </div>

@endsection
