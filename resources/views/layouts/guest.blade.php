<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet"/>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @fluxAppearance
</head>
<body class="flex font-sans min-h-screen bg-linear-to-b from-bg-gray-100 to-bg-blue-300 dark:from-bg-zinc-900 dark:to-bg-blue-700 antialiased">
<main class="flex-1 flex flex-col items-center justify-center">
  {{ $slot }}
</main>
@persist('toast')
<flux:toast/>
@endpersist
@livewireScripts
@fluxScripts
</body>
</html>