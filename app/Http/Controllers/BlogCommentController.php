<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogComment;
use App\Models\Blog;

class BlogCommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $blog = Blog::findOrFail($id);

        if (!$blog->allow_comments) {
            return redirect()->back()->with('error', 'Comments are closed for this post.');
        }

        BlogComment::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 'approved',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Thank you! Your comment has been posted.');
    }
}
