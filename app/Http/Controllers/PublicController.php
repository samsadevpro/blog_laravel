<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class PublicController extends Controller
{
    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur avec leurs catégories et tags
        $articles = Article::where('user_id', $user->id)
            ->where('draft', 0)
            ->with(['categories', 'tags'])
            ->get();

        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function show(User $user, Article $article)
    {
        // On vérifie que l'article appartient bien à l'utilisateur
        if ($article->user_id !== $user->id) {
            abort(404);
        }

        // On vérifie que l'article est publié
        if ($article->draft) {
            abort(404);
        }

        // On retourne la vue
        return view('public.show', [
            'article' => $article,
            'user' => $user
        ]);
    }

}
