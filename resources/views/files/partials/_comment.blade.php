<div class="col-sm-12 no-padding" id="replyContainer">
    @if ($file->comments->count() > 0)
        <i class="fa fa-comments" aria-hidden="true"></i> {{ $file->comments->count() }} {{ str_plural('comment', $file->comments->count()) }} <br />
        @foreach($comments as $comment)
            <div class="SINGLE-FILE-CONTENT-COMMENT-REPLY-BOX col-sm-12 no-padding">
                @if(auth()->user() && auth()->user()->roles->contains('name', 'admin'))
                    <form action="{{ route('destroy.comment', [$comment->id, $comment->commentable_id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-xs btn-danger pull-right"
                                @if ($comment->replies->count() > 0) onclick="return confirm('Are you sure you want to delete this comment? It will also delete all other sub-comments too.')" @endif >
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </form>
                @endif
                <div class="inner-contents">
                    <img src="{{$comment->user->avatar ? '/images/avatars/'.$comment->user->avatar : '/images/icons/avatar.svg' }}" alt="User avatar" class="user-avatar">
                    <h5>
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                        <div class="user-details">
                            <div class="name">
                                {{ $comment->user->name }}
                                @if($comment->user->roles->contains('name', 'admin'))
                                    <i class="fa fa-lock" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Admin"></i>
                                @endif
                            </div>
                            @if ($comment->parent_id)
                                <small>replied to {{ $comment->parent->user->name }}</small>
                            @endif
                        </div>
                    </h5>
                </div>

                <p>{{ $comment->body }}</p>

                @if(auth()->user())
                    <script>
                        $(document).ready(function(){
                            $("#SHOW-MORE-BTN-{{ $comment->id }}").click(function(){
                                $(this).text($(this).text() == 'cancel' ? 'reply' : 'cancel');
                            });
                        });
                    </script>
                    <div class="REPLY-BOX-BUTTONS">
                        <div id="changer">
                            <a href="#" id="SHOW-MORE-BTN-{{ $comment->id }}" onclick="$('#replyCommentForm-{{ $comment->id }}').toggleClass('hidden'); $('#changer').toggleClass('hidden'); return false;">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 no-padding">
                        <div class="col-sm-8 col-ms-6 no-padding">
                            <form action="{{ route('store.comment.reply', [$comment->commentable_id, $comment->id]) }}#replyContainer" method="post" id="replyCommentForm-{{ $comment->id  }}" class="hidden">
                                {{ csrf_field() }}
                                <br />
                                <textarea class="form-control" name="replyBody" required placeholder="Reply to {{ $comment->user->name }}" rows="4"></textarea>
                                <br />
                                <button type="submit" class="btn btn-sm btn-info pull-right">Reply</button>
                            </form>
                        </div>
                    </div>
                @endif

                @foreach($comment->replies as $reply)
                    <div class="col-sm-12 no-padding comment reply-box">
                        @if(auth()->user() && auth()->user()->roles->contains('name', 'admin'))
                            <form action="{{ route('destroy.comment', [$reply->id, $reply->commentable_id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-xs btn-danger pull-right">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </form>
                        @endif
                        <div class="inner-contents">
                            <img src="{{$reply->user->avatar ? '/images/avatars/'.$reply->user->avatar : '/images/icons/avatar.svg' }}" alt="User avatar" class="user-avatar">
                            <h5>
                                <small>{{ $reply->created_at->diffForHumans() }}</small>
                                <div class="user-details">
                                    <div class="name">
                                        {{ $reply->user->name }}
                                        @if($reply->user->roles->contains('name', 'admin'))
                                            <i class="fa fa-lock" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Admin"></i>
                                        @endif
                                    </div>
                                </div>
                            </h5>
                        </div>

                        <p>{{ $reply->body }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
        <br /><br />
        {{ $comments->links() }}
    @else
        No comments yet
    @endif
</div>