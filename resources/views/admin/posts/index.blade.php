@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <div class="text-end mb-3">
        <form action="{{ route('admin.posts') }}">
            @csrf
            <label for="search-description" class="form-label text-muted fw-bold">Search a post </label>
            <input type="search" name="search_description" id="search-description" class="form-control w-25 d-inline"
                placeholder="Find post description" value="{{ old('search_description', $search_description) }}">
        </form>
    </div>
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="table-primary text-secondary small">
            <tr>
                <th></th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED_AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_posts as $post)
                <tr>
                    <td class="text-end">{{ $post->id }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}"><img src="{{ $post->image }}"
                                alt="post id {{ $post->id }}" class="d-block mx-auto image-lg"></a>
                    </td>
                    <td>
                        @forelse ($post->categoryPost as $category_post)
                            <span class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</span>
                        @empty
                            <div class="badge bg-dark text-wrap">Uncategorized</div>
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $post->user->id) }}"
                            class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp;Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp;Visible
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis"></i>
                            </button>

                            @if ($post->trashed())
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#unhide-post-{{ $post->id }}"><i class="fa-solid fa-eye"></i>
                                        Unhide Post</button>
                                </div>
                            @else
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#hide-post-{{ $post->id }}"><i
                                            class="fa-solid fa-eye-slash"></i>
                                        Hide Post</button>
                                </div>
                            @endif


                        </div>
                        {{-- include modal here --}}
                        @include('admin.posts.modal.status')
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="lead text-muted text-center colspan-7">No posts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $all_posts->links() }}

@endsection
