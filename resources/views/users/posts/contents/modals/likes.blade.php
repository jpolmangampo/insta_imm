<div class="modal fade" id="likes-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-secondary">
            <div class="modal-body">
                @if($post->likes->isNotEmpty())
                    <div class="row justify-content-center">
                        <div class="col">
                            <h3 class="text-muted text-center">Users who liked this post</h3>
        
                            @foreach ($post->likes as $like) 
                                <div class="row align-items-center mt-3">
                                    <div class="col-auto">
                                        <a href="{{ route('profile.show', $like->user->id) }}">
                                            @if($like->user->name)
                                                <img src="{{ $like->user->avatar }}" alt="{{ $like->user->name }}"
                                                    class="rounded-circle avatar-sm">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                            @endif
                                        </a>
                                    </div> 
        
                                    <div class="col ps-0">
                                        <a href="{{ route('profile.show', $like->user->id) }}" 
                                            class="text-decoration-none text-dark fw-bold">{{ $like->user->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <h3 class="text-muted text-center">No Likes Yet</h3>
                @endif
            </div>

            <div class="modal-footer border-0">                    
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Go back</button>
            </div>

        </div>
    </div>
</div>  