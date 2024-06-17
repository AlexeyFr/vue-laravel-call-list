<x-app-layout>
    <section id="app" class="container"></section>
    @if(isset($listCalls) && count($listCalls) > 0)
        <script>
            var listCalls = @json($listCalls);
        </script>
    @endif
</x-app-layout>