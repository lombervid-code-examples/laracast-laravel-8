<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(50),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create', [
            'categories' => \App\Models\Category::all(),
        ]);
    }

    public function store()
    {

        $attributes = array_merge($this->validatePost(), [
            'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
        ]);

        $attributes = $this->validatePost();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        auth()->user()->posts()->create($attributes);

        return redirect('/')->with('success', 'Your post has been created.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => \App\Models\Category::all(),
        ]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            Storage::delete($post->thumbnail);
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        Storage::delete($post->thumbnail);
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(Post $post = null)
    {
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post?->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}
