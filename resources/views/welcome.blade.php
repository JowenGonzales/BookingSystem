<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation System</title>

    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

<!-- Navigation -->
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold hover:text-red-500">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="font-semibold hover:text-red-500">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold hover:text-red-500">Register</a>
            @endif
        @endauth
    @endif
</div>

<!-- Hero Section -->
<div class="min-h-screen flex flex-col items-center justify-center text-center px-6">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Our Reservation System</h1>
    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-8">
        Quickly book your appointments or check your existing reservations.
    </p>
    <div class="flex gap-4 flex-wrap justify-center">
        <a href="{{route('staff.login')}}" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Staff</a>
        <a href="{{route('login')}}" class="px-6 py-3 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition">Customer</a>
    </div>
</div>

<!-- Features Section -->
<div class="max-w-7xl mx-auto py-16 px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-2">Fast Booking</h3>
        <p class="text-gray-500 dark:text-gray-400">Book your appointments in just a few clicks without any hassle.</p>
    </div>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-2">Easy Management</h3>
        <p class="text-gray-500 dark:text-gray-400">View, edit, or cancel reservations easily from your dashboard.</p>
    </div>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-2">Secure & Reliable</h3>
        <p class="text-gray-500 dark:text-gray-400">All reservations are stored securely with full privacy and reliability.</p>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-6 text-gray-500 dark:text-gray-400">
    &copy; {{ date('Y') }} Reservation System. All rights reserved.
</footer>

</body>
</html>
