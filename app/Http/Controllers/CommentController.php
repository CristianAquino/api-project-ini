<?php

namespace App\Http\Controllers;

use App\DTOs\CommentDTO;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::query()
            ->paginate(10);
        $commentsDTO = CommentDTO::fromPagination($comments);
        return response()->json($commentsDTO, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Comment::create($request->all());
        return response()->json([
            'message' => 'Comment created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
        $commentDTO = CommentDTO::fromBaseModel($comment);
        return response()->json($commentDTO, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
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
    public function destroy(Comment $comment)
    {
        //
        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}
