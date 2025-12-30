<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="theme()"
      x-init="init()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.demo') ? config('app.demo_label') . ' — ' : '' }}{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/logo_med.png') }}">

    <style>[x-cloak]{display:none !important;}</style>

    <script>
        (function () {
            try {
                const stored = localStorage.getItem('darkMode');
                const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                const isDark = stored !== null ? (stored === 'true') : prefersDark;
                
                if (isDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {
                console.error('Error loading dark mode:', e);
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    @if(config('app.demo'))
        <div class="sticky top-0 z-50 bg-amber-100 text-amber-900 border-b border-amber-200">
            <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-6 py-2 text-sm font-medium flex items-center justify-center gap-2">
                <span class="inline-flex items-center rounded-full bg-amber-200/70 px-2 py-0.5 text-xs font-semibold uppercase tracking-wide text-amber-900">
                    {{ config('app.demo_label') }}
                </span>
                <span>{{ config('app.demo_notice') }}</span>
            </div>
        </div>
    @endif
    {{ $slot }}
    
    @livewireScripts
</body>
</html>
