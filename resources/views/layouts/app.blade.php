<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       <title>{{ $title ?? 'My Blog' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="flex h-screen bg-zinc-50 dark:bg-zinc-900">

        {{-- Sidebar --}}
        <aside class="min-w-64 bg-zinc-100 dark:bg-zinc-800 border-r border-zinc-200 dark:border-zinc-700 flex flex-col px-4 py-6">
            <div class="text-lg font-semibold text-gray-900 dark:text-white mb-8 px-2">My Blog</div>
            <nav class="flex flex-col gap-1">
                <a href="/" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                    All Posts
                </a>
                <a href="/posts/create" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 transition">
                    Create Post
                </a>
            </nav>
        </aside>

        {{-- Main content --}}
        <main class="flex-1 overflow-y-auto pt-8 px-8">
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>