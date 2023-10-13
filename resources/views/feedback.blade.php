@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-center text-white">
                        Feedback Form
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="text-primary fs-4">Title:</label>
                        <p id="title">{{ $feedback->title }}</p>
                    </div>
                    <div class="form-group">
                        <label for="category" class="text-primary fs-4">Category:</label>
                        <p id="category">{{ $feedback->category }}</p>
                    </div>
                    <div class="form-group">
                        <label for="description" class="text-primary fs-4">Description:</label>
                        <p id="description">{{ $feedback->description }}</p>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form id="comment-form">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $feedback->slug }}">
                        <textarea name="content" placeholder="Add a comment" class="form-control" id="comment-content"></textarea>
                        <button type="submit" class="btn btn-primary mt-1">Submit Comment</button>
                    </form>
                </div>
            </div>
            <div id="comments" class="mt-3">
                <!-- Display existing comments here -->
            </div>
            <div id="loading-comments" style="display: none;">
                <p>Loading comments...</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#comment-form').on('submit', function (e) {
        e.preventDefault();
        var $commentContent = $('#comment-content');
        var $loadingComments = $('#loading-comments');

        $.ajax({
            type: 'POST',
            url: "{{ route('comments.store') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $loadingComments.show();
            },
            success: function (data) {
                loadComments();
                $commentContent.val(''); // Clear the input field
            },
            complete: function () {
                $loadingComments.hide();
            }
        });
    });

    function loadComments() {
        $.get('/comments/{{ $feedback->slug }}', function (data) {
            $('#comments').html(data);
        });
    }

    // Execute the function when the page loads
    $(document).ready(function () {
        loadComments();
    });
</script>
@endpush
