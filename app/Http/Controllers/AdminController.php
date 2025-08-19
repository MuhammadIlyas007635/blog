<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {

        if (Auth::id()) {
            $usertype = Auth::user()->usertype;


            if ($usertype == 'admin') {
                $userCount = User::count();
                $postCount = Post::count();
                $adminPostCount = Post::where('user_id', Auth::id())->count();
                $userPostCount = Post::where('user_id', '!=', Auth::id())->count();
                return view('admin.home', compact('userCount', 'postCount', 'adminPostCount', 'userPostCount'));
            } else if ($usertype == 'user') {
                $user = Auth::user();
                $posts = Post::with('user', 'comments.user', 'comments.replies.user')->where('status', 'approved')->get();
                $noPosts = $posts->isEmpty();
                return view('user.home', compact('posts', 'user', 'noPosts'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function homepage()
    {
        if (Auth::id()) {
            $posts = Post::where('status', 'approved')->with('user', 'comments.user', 'comments.replies.user')->get();
            return view('user.home', compact('posts'));
        } else {
            return redirect()->route('login');
        }
    }

    public function createPost()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.create_post');
            } else if ($usertype == 'user') {
                return view('admin.create_post');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post_images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function getPost()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                $posts = Post::all();
                return view('admin.get_post', compact('posts'));
            } else if ($usertype == 'user') {
                $posts = Post::where('user_id', Auth::id())->get();
                return view('admin.get_post', compact('posts'));
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function deletePost($id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                $post = Post::findOrFail($id);
                $post->delete();
                return redirect()->back()->with('success', 'Post deleted successfully!');
            } else if ($usertype == 'user') {
                $post = Post::findOrFail($id);
                $post->delete();
                return redirect()->back()->with('success', 'Post deleted successfully!');
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function editPost($id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                $post = Post::findOrFail($id);
                return view('admin.edit_post', compact('post'));
            } else if ($usertype == 'user') {
                $post = Post::where('user_id', Auth::id())->findOrFail($id);
                return view('admin.edit_post', compact('post'));
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post_images'), $imageName);
            $post->image = $imageName;
        } else {
            // If no new image is uploaded, keep the previous image
            $post->image = $request->previous_image;
        }

        $post->save();

        return redirect()->route('get_post')->with('success', 'Post updated successfully!');
    }
    public function approvePost($id)
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                $post = Post::findOrFail($id);
                $post->status = 'approved'; // Assuming you have a status field in your Post model
                $post->save();
                return redirect()->back()->with('success', 'Post approved successfully!');
            } else {
                return redirect()->back()->with('error', 'You do not have permission to approve posts.');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
