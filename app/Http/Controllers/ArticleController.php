<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function like(Article $article)
    {
        $article->increment('likes');

        return redirect()->route('public.show', [$article->user_id, $article->id]);
    }
}
