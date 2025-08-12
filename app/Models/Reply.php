<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'reply'; // Assuming you have a replies table
    protected $primaryKey = 'id';

    protected $fillable = [
        'comment_id',
        'user_id',
        'reply',
    ];
   public function comment()
{
    return $this->belongsTo(Comment::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
