<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class LikesController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        // if (isset($request->search_description)) {
        //     $request->validate([
        //         'search_description' => 'required|min:1'
        //     ]);

        $all_posts = $this->post->where('description', 'like', '%' . $request->search_description . '%')->withTrashed()->latest()->paginate(10);
        // } else {
        //     $all_posts = $this->post->withTrashed()->latest()->paginate(10);
        // }
        return view('admin.likes.index')
            ->with('all_posts', $all_posts)
            ->with('search_description', $request->serach_description);
    }
}
