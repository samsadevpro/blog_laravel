<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;

class UserController extends Controller
{
    public function create(): View
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'nullable|string',
        ]);

        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft']);

    // Créateur de l'article (auteur)
    $data['user_id'] = Auth::user()->id;

    // Gestion du draft
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    // On crée l'article
    $article = Article::create($data);

    // On synchronise les catégories choisies dans le formulaire
    $article->categories()->sync($request->input('categories', []));

    // On redirige l'utilisateur vers la liste des articles
    return redirect()->route('dashboard')->with('success', 'Article créé avec succès !');
}
public function index()
{
    // On récupère l'utilisateur connecté.
    $articles = Article::where('user_id', Auth::user()->id)->get();

    // On retourne la vue.
    return view('dashboard', [
    'articles' => $articles
]);
}
public function edit(Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit d'accéder à cet article");
    }

    $categories = Category::all();

    // On retourne la vue avec l'article et les catégories
    return view('articles.edit', [
        'article' => $article,
        'categories' => $categories
    ]);
}

public function update(Request $request, Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit d'accéder à cet article");
    }

    // Validation des données
    $request->validate([
        'title'   => 'required|max:255',
        'content' => 'nullable|string',
    ]);

    // On récupère les données du formulaire
    $data = $request->only(['title', 'content', 'draft']);

    // Gestion du draft
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    // On met à jour l'article
    $article->update($data);

    // On synchronise les catégories choisies dans le formulaire
    $article->categories()->sync($request->input('categories', []));

    // On redirige l'utilisateur vers la liste des articles (avec un flash)
    return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
}

public function remove(Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        return redirect()->route('dashboard')->with('error', "Vous n'avez pas le droit d'accéder à cet article");
    }

    // On supprime l'article
    $article->delete();

    // On redirige l'utilisateur vers la liste des articles (avec un flash)
    return redirect()->route('dashboard')->with('success', 'Article supprimé !');
}
}


