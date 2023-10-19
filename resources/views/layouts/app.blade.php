<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - @yield('title')</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/">
                <h1 class="text-3xl font-black">Devstragram</h1>
            </a>
            <nav class="flex gap-x-10 items-center">
                @auth
                <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', ['user' => auth()->user()]) }}">
                    Hola: 
                    <span class="font-normal">
                        {{auth()->user()->username}}
                    </span>
                </a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                        <span class="font-normal">
                            Cerrar Sesión
                        </span>
                    </button>
                </form>
                @endauth
                @guest
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('title')
        </h2>
        @yield('content')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Devstragram - Todos los derechos reservados. {{ date('Y') }}
    </footer>

</body>

</html>
