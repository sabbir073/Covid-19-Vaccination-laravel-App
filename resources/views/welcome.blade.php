<!-- resources/views/registration.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Covid 19 Vaccination System</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    @viteReactRefresh
    @vite('resources/js/app.jsx') <!-- Update to point to app.jsx -->
</head>
<body class="bg-gray-100">
    <div id="app"></div> <!-- React will mount here -->
</body>
</html>
