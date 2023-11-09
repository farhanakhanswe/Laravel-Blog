<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Article\StoreArticleRequest;
use App\Http\Requests\Web\Article\UpdateArticleRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::eagerLoadAllArticlesWithTagsWithSimplePagination();

        return view('web.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::getAllCategoryIdsAndNames();
        $tags = Tag::getAllTagIdsAndNames();

        return view('web.articles.create', compact('categories', 'tags'));
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article = Auth::user()->articles()->create([
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id(),
            'category_id' => $request->category,
            'status' => $request->status === "on"
        ] + $request->validated());

        $article->tags()->attach($request->tags);

        return redirect(route('my-articles'))->with('success', 'Article has successfully been created!');
    }

    public function show(Article $article)
    {
        return view('web.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::getAllCategoryIdsAndNames();
        $tags = Tag::getAllTagIdsAndNames();

        return view('web.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update([
            'slug' => Str::slug($request->title),
            'category_id' => $request->category,
            'status' => $request->status === "on"
        ] + $request->validated());

        $article->tags()->sync($request->tags);

        return redirect(route('my-articles'))->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return back()->with('success', 'Article deleted successfully!');
    }
}
