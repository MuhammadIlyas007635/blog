<?php

namespace App\Http\Controllers;




use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

public function  add_comment(Request $request)
{
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

     $post = Post::findOrFail($request->post_id);
     $user = Auth::id();


$comment = new Comment();
$comment->post_id = $post->id;
$comment->user_id = $user;
$comment->comment = $request->comment;

$comment->save();
    return redirect()->back()->with('success', 'Comment added successfully!');

}

public function getcomment($postId)
{
    $comments=Comment::where('post_id', $postId)->with('user')->get();
return view(('user.posts'), compact('comments'));
}

// public function about_user()
// {
//     $user = Auth::user();
//  // Debugging line to check user data
//     return view('user.about', compact('user')); // Adjusted view name to match your user profile view
// }

public function addReply(Request $request)
{
 // Debugging line to check request data

 // Debugging line to check request data
    $request->validate([
        'comment_id' => 'required|exists:comments,id',
        'reply' => 'required|string|max:1000',
    ]);
$user = Auth::user();
    Reply::create([
        'comment_id' => $request->comment_id,
       'user_id' => $user->id,
        'reply' => $request->reply,
    ]);

    return redirect()->back()->with('success', 'Reply added!');
}
}

