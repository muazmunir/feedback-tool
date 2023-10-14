@foreach ($comments as $comment)
    <div class="card mt-2">
        <div class="card-header justify-content-between d-flex">
            <div>
            {{ $comment->user->name }}
            </div>
            <div>
                {{ $comment->created_at }}
            </div>
        </div>
        <div class="card-body">
            {!! $comment->content !!}
        </div>
    </div>
@endforeach
