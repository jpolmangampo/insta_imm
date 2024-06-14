@extends('layouts.app')

@section('title', 'Explore People')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5">
            <h3 class="text-muted text-center">Search result for <span class="fw-bold">"{{ $search }}"</span></h3>

            @forelse ($users as $user)
                <div class="row align-items-center mt-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                    </div>

                    <div class="col ps-0">
                        <a href="{{ route('profile.show', $user->id) }}"
                            class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    </div>

                    <div class="col-auto text-end">
                        @if ($user->id != Auth::user()->id)
                            @if ($user->isFollowed())
                                <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="border-0 bg-transparent p-0 text-secondary">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @empty
                <p class="lead text-muted text-center">No users found</p>
            @endforelse
        </div>
    </div>
@endsection
