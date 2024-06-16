<x-app-layout>
    <section id="app" class="container"></section>
    @if(isset($ListCall) && count($ListCall) > 0)
        <script>
            var ListCall = @json($ListCall);
        </script>
    @endif
</x-app-layout>