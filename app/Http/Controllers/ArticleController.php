<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::all();
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Article::create($request->all());
        return response()->json([
            'message' => 'Article created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
        $article->update($request->all());
        return response()->json([
            'message' => 'Article updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return response()->json([
            'message' => 'Article deleted successfully'
        ]);
    }
}
