<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un article
        </h2>
    </x-slot>

    <form method="post" action="{{ route('articles.store') }}" class="py-12">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                   <!-- Input de titre de l'article -->
                   <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Titre de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="p-6 pt-0 text-gray-900 ">
                   <!-- Contenu de l'article -->
                   <textarea rows="10" name="content" id="content" placeholder="Contenu de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('content') }}</textarea>
                </div>

                <div class="p-6 pt-0 text-gray-900">
                    <label class="block font-medium text-sm text-gray-700 mb-2">Catégories</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <label for="category_{{ $category->id }}" class="ml-2 text-sm text-gray-600">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                            <strong>Oups !</strong> Veuillez corriger les erreurs suivantes :
                            <ul class="list-disc ml-5 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <!-- Action sur le formulaire -->
                        <div class="flex items-center">
                            <input type="checkbox" name="draft" id="draft" {{ old('draft') ? 'checked' : '' }} class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="draft" class="ml-2">Article en brouillon</label>
                        </div>
                        <button type="submit" style="background-color: #3b82f6; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer;" class="bg-blue-500 hover:bg-blue-700">
                            Créer l'article
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>