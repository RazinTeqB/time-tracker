<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if (session('info'))
                <div
                    x-data="{ show_info: true }" x-show="show_info" x-init="setTimeout(() => show_info = false, 3000)"
                    class="mt-4 p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert"
                >{{ session('info') }}</div>
            @endif
            @if (session('danger'))
                <div
                    x-data="{ show_danger: true }" x-show="show_danger" x-init="setTimeout(() => show_danger = false, 3000)"
                    class="mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert"
                >{{ session('danger') }}</div>
            @endif
            @if (session('success'))
                <div
                    x-data="{ show_success: true }" x-show="show_success" x-init="setTimeout(() => show_success = false, 3000)"
                    class="mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert"
                >{{ session('success') }}</div>
            @endif
            @if (session('warning'))
                <div
                    x-data="{ show_warning: true }" x-show="show_warning" x-init="setTimeout(() => show_warning = false, 3000)"
                    class="mt-4 p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert"
                >{{ session('warning') }}</div>
            @endif


            <!-- Page Content -->
            <main>
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
