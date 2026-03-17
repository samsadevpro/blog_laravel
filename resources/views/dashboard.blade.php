<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('articles.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Créer un nouvel article
                        </a>
                        <a href="{{ route('public.index', Auth::user()->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Voir mon profil public
                        </a>
                    </div>
                    
                </div>        
            </div>
            @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
        {{ session('success') }}
    </div>
@endif
            @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
                {{ session('error') }}
            </div>
        @endif
            @foreach ($articles as $article)
            
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold">
                {{ $article->title }}
                @if ($article->draft)
                    <span class="ml-2 text-sm font-normal bg-gray-200 text-gray-800 py-1 px-2 rounded">Brouillon</span>
                @else
                    <span class="ml-2 text-sm font-normal bg-green-100 text-green-800 py-1 px-2 rounded">Publié</span>
                @endif
            </h2>
            <p class="text-gray-700">{{ substr($article->content, 0, 30) }}...</p>
                <div class="text-right flex justify-end space-x-4">
                    <a href="{{ route('articles.edit', $article->id) }}" class="text-indigo-500 hover:text-indigo-700">Modifier</a>
                    <a href="{{ route('articles.remove', $article->id) }}" class="text-red-500 hover:text-red-700">Supprimer</a>
                </div>
        </div>
    </div>
@endforeach

        </div>  
    </div>
</x-app-layout>


