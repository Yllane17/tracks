<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container d-flex flex-column min-vh-100">   <!-- Utilisation de flexbox pour que le footer reste en bas de la page -->
            @include('template.header')
            <main class="flex-grow-1">  <!-- Le contenu principal prend tout l'espace disponible -->
                @yield('content')
            </main>
            @include('template.footer')
        </div>
    </body>
</html>
