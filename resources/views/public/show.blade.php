<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->title }}
        </h2>
    </div>

    <div class="flex justify-center flex-wrap gap-2 mt-2">
    @foreach($article->categories as $category)
        <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs px-2 py-1 rounded-full uppercase tracking-wide font-semibold">
            {{ $category->name }}
        </span>
    @endforeach
</div>

    <div class="text-gray-500 text-sm">
        Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}">{{ $article->user->name }}</a>
    </div>

    <div>
        <div class="p-6 text-gray-900">
            <p class="text-gray-700">{{ $article->content }}</p>
        </div>
    </div>

    {{-- Bouton Like --}}
    <div class="flex items-center gap-4 px-6 pb-4">
        @auth
        <form action="{{ route('article.like', $article->id) }}" method="POST">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-700 text-blue font-bold py-2 px-4 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                </svg>
                J'aime &middot; {{ $article->likes }}
            </button>
        </form>
        @endauth

        @guest
        <div class="inline-flex items-center gap-2 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
            </svg>
            {{ $article->likes }} like(s)
        </div>
        @endguest
    </div>

    <div class="mt-8 border-t border-gray-200 pt-8">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Commentaires ({{ $article->comments->count() }})
        </h3>

        <!-- Liste des commentaires -->
        <div class="space-y-4 mb-8">
            @forelse ($article->comments as $comment)
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-700">{{ $comment->content }}</p>
                    <div class="mt-2 text-xs text-gray-500">
                        Par {{ $comment->user->name }} le {{ $comment->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
            @empty
                <p class="text-gray-500 italic">Aucun commentaire pour le moment.</p>
            @endforelse
        </div>

        <!-- Formulaire d'ajout de commentaire -->
        @auth
            <form action="{{ route('comments.store') }}" method="post" class="bg-gray-50 p-6 rounded-lg shadow-sm">
                @csrf
                <input type="hidden" name="articleId" value="{{ $article->id }}">

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Votre commentaire</label>
                    <textarea name="content" id="content" rows="3" 
                        class="w-full rounded-lg border-gray-300 bg-white text-gray-900 focus:ring-indigo-500 focus:border-indigo-500" 
                        placeholder="Exprimez-vous..." required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Envoyer le commentaire
                    </button>
                </div>
            </form>
        @else
            <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center">
                <p class="text-gray-800">
                    <a href="{{ route('login') }}" class="font-bold hover:underline">Connectez-vous</a> pour ajouter un commentaire.
                </p>
            </div>
        @endauth
    </div>
</x-guest-layout>
