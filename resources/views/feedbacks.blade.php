@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-center text-white">
                            All Feedbacks
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Vote Count</th>
                                    <th>Submitted By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedbackItems as $feedback)
                                    <tr>
                                        <td> <a href="{{ route('feedback', $feedback->slug) }}">{{ $feedback->title }}</a> </td>
                                        <td>{{ $feedback->category }}</td>
                                        <td>{{ $feedback->vote_count }}</td>
                                        <td>{{ $feedback->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $feedbackItems->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
