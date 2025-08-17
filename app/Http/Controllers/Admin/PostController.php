<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with(['category', 'author', 'tags']);

        // Filter by title
        if (request('title')) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }

        $posts = $query->latest()->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::active()->ordered()->get();
        $tags = PostTag::active()->get();
        
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:post_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'featured' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:post_tags,id'
        ]);

        $data = $request->all();
        $data['author_id'] = Auth::id();
        $data['featured'] = $request->has('featured');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post = Post::create($data);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Bài viết đã được tạo thành công!');
    }

    public function edit(Post $post)
    {
        $categories = PostCategory::active()->ordered()->get();
        $tags = PostTag::active()->get();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:post_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'featured' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:post_tags,id'
        ]);

        $data = $request->all();
        $data['featured'] = $request->has('featured');
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post->update($data);

        // Sync tags
        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function toggleStatus(Post $post)
    {
        if ($post->status === 'published') {
            $post->update(['status' => 'draft']);
            $message = 'Bài viết đã được chuyển về bản nháp!';
        } else {
            $post->update([
                'status' => 'published',
                'published_at' => now()
            ]);
            $message = 'Bài viết đã được xuất bản!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function toggleFeatured(Post $post)
    {
        $post->update(['featured' => !$post->featured]);
        
        $message = $post->featured ? 'Bài viết đã được đánh dấu nổi bật!' : 'Bài viết đã bỏ đánh dấu nổi bật!';
        
        return redirect()->back()->with('success', $message);
    }
}


