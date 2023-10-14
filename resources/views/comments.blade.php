@foreach ($comments as $comment)
    <div class="card mt-2">
        <div class="card-header">
            {{ $comment->user->name }}
        </div>
        <div class="card-body">
            {{ $comment->content }}
        </div>
    </div>
@endforeach
