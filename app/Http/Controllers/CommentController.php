<?php

namespace App\Http\Controllers;

use App\DTOs\CommentDTO;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article)
    {
        //
        $comments = $article->comments()->paginate(10);
        $commentsDTO = CommentDTO::fromPagination($comments);
        return response()->json($commentsDTO, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Article $article)
    {
        //
        $article->comments()->save(new Comment($request->all()));
        return response()->json([
            'message' => 'Comment created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article, Comment $comment)
    {
        //
        $comment = $article->comments()->find($comment->id);
        $commentDTO = CommentDTO::fromBaseModel($comment);
        return response()->json($commentDTO, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article, Comment $comment)
    {
        //
        $comment->update($request->all());
        return response()->json([
            'message' => 'Comment updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, Comment $comment)
    {
        //
        $comment = $article->comments()->find($comment->id);
        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}
