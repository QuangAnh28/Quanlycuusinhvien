<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // Ai cũng xem được, chỉ lấy bài published (nếu admin muốn xem cả draft thì chỉnh sau)
        $posts = Post::where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Ai cũng xem được, nhưng chỉ xem published
        abort_unless($post->status === 'published' || (auth()->check() && auth()->user()->role === 'admin'), 404);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        // Route đã chặn role:admin, thêm 1 lớp nữa cho chắc
        abort_unless(auth()->user()->role === 'admin', 403);

        return view('posts.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $data = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image'   => ['nullable', 'string', 'max:255'], // tạm dùng link ảnh
            'status'  => ['required', 'in:draft,published'],
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['created_by'] = auth()->id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Đăng bài thành công!');
    }

    public function edit(Post $post)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $data = $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image'   => ['nullable', 'string', 'max:255'],
            'status'  => ['required', 'in:draft,published'],
        ]);

        // nếu đổi title thì cập nhật slug cho hợp lý
        if ($data['title'] !== $post->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $post->id);
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Post $post)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Đã xoá bài viết!');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 2;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}