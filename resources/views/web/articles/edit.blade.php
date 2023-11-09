@extends('layouts.web.app')

@section('content')
    <div class="container d-flex justify-content-center my-5">
        <div class="card" style="width: 80%">
            <div class="card-body">
                <div class="card-title">
                    <h3>Edit {{ $article->title }}</h3>
                </div>
                <form action="{{ route('articles.update', $article->slug) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input class="form-control" type="text" name="title" value="{{ $article->title }}">
                        @if ($errors->has('title'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('title') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <input class="form-control" type="text" value="{{ $article->description }}" name="description">
                        @if ($errors->has('description'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('description') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Summary</label>
                        <input class="form-control" type="text" value="{{ $article->summary }}" name="summary">
                        @if ($errors->has('summary'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('summary') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Select Category</label>
                        <select class="form-select" name="category">
                            @forelse($categories as $categoryId => $categoryName)
                                <option value="{{ $categoryId }}"
                                    {{ $article->category->id === $categoryId ? 'selected' : '' }}>
                                    {{ $categoryName }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        @if ($errors->has('category'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('category') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Select Tags</label>
                        <select class="form-select" name="tags[]" multiple>
                            @forelse($tags as $tagId => $tagName)
                                <option value="{{ $tagId }}"
                                    {{ in_array($tagId, $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $tagName }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        @if ($errors->has('tags'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('tags') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status">
                            <label class="form-check-label">
                                Active
                            </label>
                        </div>
                        @if ($errors->has('status'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('status') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
