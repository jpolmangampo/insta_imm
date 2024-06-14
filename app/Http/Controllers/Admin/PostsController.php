<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        $all_posts = $this->post->where('description', 'like', '%' . $request->search_description . '%')->withTrashed()->latest()->paginate(10);

        return view('admin.posts.index')
            ->with('all_posts', $all_posts)
            ->with('search_description', $request->search_description);
    }

    public function hide($id)
    {
        $this->post->destroy($id);
        return redirect()->back();
    }

    public function unhide($id)
    {
        $this->post->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
