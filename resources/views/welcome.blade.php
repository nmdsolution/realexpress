<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        /* Your existing styles here */
    </style>
</head>
<body>
<div class="min-h-screen bg-white">
    <div class="py-6">
        <!-- Your existing content here -->

        <!-- Example of adding a button -->
        <div class="text-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <a href="{{ url('/admin/') }}">Admin Dashboard</a>
            </button>
        </div>

        <!-- Your existing footer and closing tags -->
    </div>
</div>
</body>
</html>
