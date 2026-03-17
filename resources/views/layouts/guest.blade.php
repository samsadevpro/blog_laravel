@php use Illuminate\Support\Facades\Route; @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">

        <div class="min-h-screen flex flex-col">

            @auth
                @include('layouts.navigation')
            @endauth

            @guest
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
                    </div>
                @endif
            @endguest

            <main class="flex-grow container mx-auto px-4 py-12">
                <div class="w-full">
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-white border-t border-gray-200 mt-auto">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm">
                        <div>
                            &copy; {{ date('Y') }} {{ config('app.name') }}.
                        </div>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="hover:text-indigo-600">À propos</a>
                            <a href="#" class="hover:text-indigo-600">Contact</a>
                            <a href="#" class="hover:text-indigo-600">Confidentialité</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </body>
</html>