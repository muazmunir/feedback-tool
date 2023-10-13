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
                    <form action="" method="POST">
                        @csrf
                        <textarea name="content" placeholder="Add a comment" class="form-control"></textarea>
                        <button type="submit" class="btn btn-primary mt-1">Submit Comment</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
