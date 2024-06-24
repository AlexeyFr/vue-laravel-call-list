@extends('layouts.app')

@section('content')
<section id="app" class="container"></section>
    @if(isset($listCalls) && count($listCalls) > 0)
        <script>
            var listCalls = @json($listCalls);
        </script>
    @endif
@endsection
