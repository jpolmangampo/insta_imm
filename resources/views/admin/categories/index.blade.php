@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row gx-2 mb-4">
            <div class="col-4">
                <input type="text" name="name" placeholder="Add a category..." class="form-control" autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>
            </div>
            {{-- error --}}
        </div>
    </form>
    <div class="row">
        <div class="col-7">
            <table class="table table-hover align-middle bg-white border table-sm text-secondary text-center">
                <thead class="table-warning small text-secondary">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th>LAST UPDATED</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="text-dark"><a href="{{ route('post.category_posts', $category->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $category->name }}</a></td>
                            <td>{{ $category->categoryPost->count() }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                {{-- Edit button --}}
                                <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#edit-category-{{ $category->id }}" title="Edit"><i
                                        class="fa-solid fa-pen"></i></button>
                                {{-- Delete Button --}}
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete-category-{{ $category->id }}"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        {{-- Include the modal here --}}
                        @include('admin.categories.modal.action')
                    @empty
                        <tr>
                            <td class="lead text-muted text-center" colspan="5">No categories found.</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td></td>
                        <td class="text-dark">
                            Uncategorized <p class="xsmall mb-0 text-muted">Hidden posts are not included</p>
                        </td>
                        <td>{{ $uncategorized_count }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
