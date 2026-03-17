<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{    public function store(Request $request)    {
        // On récupère l'ID depuis le champ 'articleId' du formulaire
        $article = Article::findOrFail($request->articleId);

        Comment::create([
            'content' => $request->content,
            'article_id' => $article->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('public.show', [$article->user, $article]);    }
}