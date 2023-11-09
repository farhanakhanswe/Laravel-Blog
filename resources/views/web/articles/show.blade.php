@extends('layouts.web.app')

@section('content')
    <div class="container my-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Title: {{ $article->title }}</h5>
                        <h6>Date: {{ $article->created_at->format('M jS Y') }}</h6>
                        <p><strong>Slug:</strong> {{ $article->slug }}</p>
                        <p><strong>Description:</strong> {{ $article->description }}</p>
                        <p><strong>Summary:</strong> {{ $article->summary }}</p>
                        <p><strong>Status:</strong> {{ $article->status }}</p>
                        <p><strong>Written by:</strong> {{ $article->user->name }}</p>
                         <p><strong>Category:</strong>
                            <span>
                                <button class="btn btn-sm btn-secondary">{{ $article->category->name }}</button>
                            </span>
                        </p>
                        <p><strong>Tags:</strong>
                            <span>
                                @forelse($article->tags as $tag)
                                    <button class="btn btn-sm btn-danger">{{ $tag->name }}</button>
                                @empty
                                @endforelse
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
