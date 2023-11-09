@extends('layouts.web.app')

@section('content')
    <div class="container p-3">
        <div class="row my-3">
            <a href="{{ route('articles.create') }}"><button class="btn btn-primary">Create Article</button></a>
        </div>

        <div class="row">
            @forelse($articles as $article)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('articles.show', $article->slug) }}">
                                <h5>Title: {{ $article->title }}</h5>
                            </a>
                            <h6>Date: {{ $article->created_at->format('M jS Y') }}</h6>
                            <p><strong>Slug:</strong> {{ $article->slug }}</p>
                            <p><strong>Summary:</strong> {{ $article->summary }}</p>
                            <p><strong>Status:</strong> {{ $article->status }}</p>
                            <p><strong>Written by:</strong> {{ $article->user->name }}</p>
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
            @empty
                <h1> No Articles Yet </h1>
            @endforelse
            <div class="d-flex justify-content-center my-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
