<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            padding: 3rem 0;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            color: white;
            margin-bottom: 2rem;
        }

        .content {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: #4338ca;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="header">
        <div class="container">
            <h1>Welcome to Our Application</h1>
            <p>A Laravel application</p>
            <a href="{{ route('user.index') }}" class="btn">View Users</a>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <h2>About This Application</h2>
            <p>This is a simple Laravel application for managing users.</p>
            <p>Use the navigation above to explore the features.</p>
        </div>
    </div>
</body>

</html>