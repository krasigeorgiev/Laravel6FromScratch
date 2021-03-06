<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        // Render a list of a resource.
        $articles = Article::latest()->get();

        return view('articles.index', ['articles' => $articles]);
    }
    public function show(Article $article)
    {
        // Show a single resource.
        // $article = Article::findOrFail($id);

        //return $article;

        return view('articles.show', ['article' => $article]);
    }

    public function create()
    {
        // Shows a view to create a new resource
        return view('articles.create');
    }

    public function store()
    {
        \request()->validate([
           'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        // Persist the new resource
        $article = new Article();

        $article->title = \request('title');
        $article->excerpt = \request('excerpt');
        $article->body = \request('body');

        $article->save();

        return redirect('/articles');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }
    public function update(Article $article)
    {
        \request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('/articles/' . $article->id);
    }
    public function destroy()
    {
        // Delete the resource
    }
}
