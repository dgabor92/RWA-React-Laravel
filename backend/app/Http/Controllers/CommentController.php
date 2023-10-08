<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $validationRules = [
        "body" => "required|string",
        "article_id" => "required|integer",
    ];
    private $fillable = [
        "body",
        "article_id",
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json([
            'comments' => $comments,
            "commentsCount" => $comments->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = auth()->user();
        $request->validate($this->validationRules);
        $comment = new Comment();
        foreach ($this->fillable as $field) {
            $comment->$field = $request->$field;
        }
        $comment->author = [
            "username" => $user->username,
            "bio" => $user->bio,
            "image" => $user->image,
            "following" => false,
        ];
        $comment->save();
        return response()->json([
            'comment' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $id = $request->id;
        $updatedComment = Comment::find($id)->update($request->all());
        return response()->json($updatedComment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Comment deleted',
            "status" => 204
        ]);
    }
}
