<?php

namespace App\Http\Controllers;

use App\DTOs\ArticleDTO;
use App\Models\Article;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::query()
            ->paginate(10);
        $articlesDTO = ArticleDTO::fromPagination($articles);
        return response()->json($articlesDTO, Response::HTTP_OK);
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
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        $articleDTO = ArticleDTO::fromBaseModel($article);
        return response()->json($articleDTO, Response::HTTP_OK);
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
        ], Response::HTTP_ACCEPTED);
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
        ], Response::HTTP_ACCEPTED);
    }
}
