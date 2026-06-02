<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mon Super Quiz</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
        
        <header class="w-full p-6 flex justify-end items-center">
            @if (Route::has('login'))
                <nav class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition">
                            Mon Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 transition">
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-sm">
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-grow flex flex-col items-center justify-center px-6 text-center">

            <h1 class="text-5xl md:text-7xl font-black tracking-tight mb-6 text-gray-900 dark:text-white">
                Prêt à tester tes <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Connaissances ?</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mb-10">
                Rejoins la communauté, réponds à des questions dans diverses catégories et hisse-toi au sommet du classement !
            </p>

            <div>
                @auth
                    <a href="{{ url('/quiz/play') }}" class="inline-block bg-indigo-600 text-white font-bold text-lg px-8 py-4 rounded-xl hover:bg-indigo-700 hover:scale-105 transition-all shadow-lg">
                        Lancer une partie 🚀
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white font-bold text-lg px-8 py-4 rounded-xl hover:bg-indigo-700 hover:scale-105 transition-all shadow-lg">
                        Créer un compte pour jouer
                    </a>
                    <p class="mt-4 text-sm text-gray-500">
                        Déjà inscrit ? <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Connecte-toi</a>
                    </p>
                @endauth
            </div>
        </main>
    </body>
</html>