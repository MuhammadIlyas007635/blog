<div class="container">
    <h1 class="services_taital">Posts</h1>
    <p class="services_text">See the posts and comments on it</p>

    <div class="services_section_2">
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4 mb-5">
                    <h3 class="service_text">{{ $post->user->name }}</h3>

                    <div>
                        <img src="{{ asset('post_images/' . $post->image) }}" class="services_img" height="300px">
                    </div><br><br><br><br>

                    <h3 class="service_text">{{ $post->title }}</h3>

                    <div class="mt-3">
                        <h5>Comments:</h5>
                        @foreach ($post->comments as $comment)
                            <div class="mb-2">
                                @auth
                                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                                @endauth

                                <div class="ml-3">
                                    @foreach ($comment->replies as $reply)
                                        @auth
                                            <div style="margin-left: 20px;">
                                                <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->reply }}</p>
                                            </div>
                                        @endauth
                                    @endforeach
                                </div>

                                @auth
                                    <button onclick="toggleReplyForm({{ $comment->id }})" class="btn btn-sm btn-primary mb-2">
                                        Reply
                                    </button>

                                    <form action="{{ route('add_reply') }}" method="POST" class="mt-2"
                                        id="reply-form-{{ $comment->id }}" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <div class="form-group">
                                            <textarea name="reply" class="form-control mb-2" rows="2" placeholder="Write a reply..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm">Submit Reply</button>
                                    </form>
                                @endauth
                            </div>
                        @endforeach
                    </div>

                    @auth
                        <button onclick="toggleCommentForm({{ $post->id }})"
                            style="display:block; background-color: #007bff; color: white; padding: 8px 16px; border:none; cursor:pointer; margin-top: 10px;">
                            Add Comment
                        </button>

                        <form action="{{ route('add_comment') }}" method="POST" class="mt-2"
                            id="comment-form-{{ $post->id }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-1">Submit</button>
                        </form>
                    @else
                        <p class="mt-2">Please <a href="{{ route('login') }}" class="btn btn-primary">login</a> to
                            comment.</p>
                    @endauth
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">🚫there are no posts.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<script>
    function toggleCommentForm(postId) {
        const form = document.getElementById('comment-form-' + postId);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }

    function toggleReplyForm(commentId) {
        const form = document.getElementById('reply-form-' + commentId);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }
</script>
