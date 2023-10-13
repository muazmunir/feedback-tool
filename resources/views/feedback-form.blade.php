@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-center text-white">
                            Feedback Form
                        </div>
                    </div>
                    <div class="card-body">
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('feedback.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter The Title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="category">Category:</label>
                                <select name="category" class="form-select" >
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="bug">Bug Report</option>
                                    <option value="feature">Feature Request</option>
                                    <option value="improvement">Improvement</option>
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" placeholder="Enter The Description" rows="5" >{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
