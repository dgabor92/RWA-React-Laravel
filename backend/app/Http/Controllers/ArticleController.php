<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $validationRules = [
        "slug" => "required|string",
        "title" => "required|string",
        "description" => "required|string",
        "body" => "required|string",
        "tagList" => "required|array",
        "author" => "required|json",
    ];

    private $fillable = [
        "slug",
        "title",
        "description",
        "body",
        "tagList",
        "author",
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Article::all();  // return all articles
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
        $request->validate($this->validationRules);
        $article = new Article();
        foreach ($this->fillable as $field) {
            $article->$field = $request->$field;
        }
        $article->save();
        return $article;
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $id = $request->id;
        $updatedArticle = Article::find($id)->update($request->all());
        return response()->json($updatedArticle, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            'success' => true,
            'message' => 'Article deleted',
            "status" => 204
        ]);
    }
}
