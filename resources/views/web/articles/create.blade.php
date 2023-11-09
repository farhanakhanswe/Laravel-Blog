@extends('layouts.web.app')

@section('content')
    <div class="container d-flex justify-content-center my-5">
        <div class="card" style="width: 80%">
            <div class="card-body">
                <div class="card-title">
                    <h3>Create an article</h3>
                </div>
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input class="form-control" type="text" placeholder="Enter Title" name="title">
                        @if ($errors->has('title'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('title') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <input class="form-control" type="text" placeholder="Enter Description" name="description">
                        @if ($errors->has('description'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('description') }}.</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Summary</label>
                        <input class="form-control" type="text" placeholder="Enter Summary" name="summary">
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
                                <option value="{{ $categoryId }}">{{ $categoryName }}</option>
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
                                <option value="{{ $tagId }}"> {{ $tagName }}</option>
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
