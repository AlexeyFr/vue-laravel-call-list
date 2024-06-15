<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vue-Laravel Call-List</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    @vite('resources/css/app.css')
</head>
<body>
    @if(isset($ListCall) && count($ListCall) > 0)
        <script>
            var ListCall = @json($ListCall);
        </script>
    @endif

    <x-app-layout>
        <section id="app"></section>
    </x-app-layout>
    @vite('resources/js/app.js')
</body>
</html>
