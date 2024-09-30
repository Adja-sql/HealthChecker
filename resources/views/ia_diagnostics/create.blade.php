@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Diagnostic IA</h1>

    @if(isset($question))
        <h3>{{ $question['text'] }}</h3>
        <form action="{{ route('ia_diagnostics.process') }}" method="POST">
            @csrf
            @foreach($question['items'] as $item)
                <div>
                    <input type="radio" name="answer" value="{{ $item['id'] }}" required> {{ $item['name'] }}
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    @else
        <p>Impossible de démarrer le diagnostic.</p>
    @endif
</div>
@endsection
