<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vue-Laravel Call-List</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    @vite('resources/css/app.css')
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">Vue-Laravel Call-List</h2>
        </x-slot>
        <section id="app"></section>
    </x-app-layout>
    @vite('resources/js/app.js')
</body>
</html>
