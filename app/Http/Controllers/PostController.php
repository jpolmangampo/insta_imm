<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {
        $all_categories = $this->category->all();
        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'      => 'required|array|between:1,3',
            'description'   => 'required|min:1|max:1000',
            'image'         => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        $this->post->user_id       = Auth::user()->id;
        $this->post->description   = $request->description;
        $this->post->image         = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        foreach ($request->category as $category_id) {
            $category_post[] = ['category_id' => $category_id];
        }
        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');
    }

    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        if (Auth::user()->id != $post->user->id && Auth::user()->role_id != 1) {
            return redirect()->route('index');
        }

        $all_categories = $this->category->all();

        $selected_categories = []; // will be used to store the current categories of the post
        foreach ($post->categoryPost as $category_post) {
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
            ->with('post', $post)
            ->with('all_categories', $all_categories)
            ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category'      => 'required|array|between:1,3',
            'description'   => 'required|min:1|max:1000',
            'image'         => 'mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        $post               = $this->post->findOrFail($id);
        $post->description  = $request->description;

        if ($request->image) {
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        $post->categoryPost()->delete(); //delete all categoryPost record with post_id similar to the id of the post to update

        foreach ($request->category as $category_id) { //for every selected category (checked checkboxes), add it to $category_post array
            $category_post[] = ['category_id' => $category_id];
        }
        $post->categoryPost()->createMany($category_post); //save all category id from $category_post[] to categoryPost table

        return redirect()->route('post.show', $id);
    }

    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('index');
    }

    public function categoryPosts($category_id)
    {

        $category = $this->category->findOrFail($category_id);
        $category_posts = [];

        foreach ($category->categoryPost as $category_post) {
            if ($category_post->post->user->isFollowed() || $category_post->post->user->id === Auth::user()->id) {
                $category_posts[] = $category_post;
            }
        }
        return view('users.posts.category_posts')
            ->with('category_posts', $category_posts)
            ->with('category', $category);
    }
}
