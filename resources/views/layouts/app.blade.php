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

        <!-- Social media layouts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            @if(!\Illuminate\Support\Str::startsWith(Request::path(), 'chatify'))
                <a id="openChatButton" class="fixed bottom-5 right-5 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-full shadow-lg flex items-center space-x-2" href="chatify">
                    <i class="fas fa-comment-dots"></i>
                    <span>Chat</span>
                </a>
            @endif
            <!-- Define the main layout with flex and min-h-screen -->
            <div class="flex flex-col min-h-screen bg-gray-900 text-white">

            <!-- Main content area, where your page content goes -->
            <main class="flex-grow">
                <!-- Content here (e.g., About Us page, other sections) -->
                {{ $slot }}
            </main>

            <!-- Footer Section -->
            <footer class="bg-gray-800 text-gray-300 py-10">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- About Section -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-100">About Us</h3>
                            <p class="mt-4 text-gray-400 leading-relaxed">We are dedicated to building a vibrant community that bridges the gap between students, alumni, and industry professionals. Join us to learn, grow, and make an impact.</p>
                        </div>

                        <!-- Quick Links Section -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-100">Quick Links</h3>
                            <ul class="mt-4 space-y-2">
                                <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-200 transition">Home</a></li>
                                <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-gray-200 transition">About Us</a></li>
                            </ul>
                        </div>

                        <!-- Contact and Social Media Section -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-100">Connect with Us</h3>
                            <p class="mt-4 text-gray-400">Email us at: <a href="mailto:info@example.com" class="text-indigo-400 hover:text-indigo-300">info@example.com</a></p>
                            <p class="mt-2 text-gray-400">Call us: <span class="text-gray-100">+123 456 7890</span></p>
                            <div class="flex mt-6 space-x-6">
                                <a href="#" class="text-gray-400 hover:text-indigo-300 transition"><i class="fab fa-linkedin fa-lg"></i></a>
                                <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="#" class="text-gray-400 hover:text-blue-300 transition"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="#" class="text-gray-400 hover:text-gray-300 transition"><i class="fab fa-github fa-lg"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="mt-10 border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
                        <p>&copy; {{ now()->year }} Your Company. All rights reserved.</p>
                        <p class="mt-2">
                            <a href="#" class="hover:text-gray-200 transition">Privacy Policy</a> |
                            <a href="#" class="hover:text-gray-200 transition">Terms of Service</a>
                        </p>
                    </div>
                </div>
            </footer>
            </div>
        </div>
    </body>
</html>