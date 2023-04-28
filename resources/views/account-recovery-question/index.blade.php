<x-layout>
    <a href="{{ route('question.create') }}">Create Question</a>
    @if(count($questions) > 0)
        @foreach ($questions as $question)
        <p>{{ $question['question'] }}</p>
        <a href="{{ route('question.show',$question['id']) }}">Show</a>
        @endforeach
    @else
        EMPTY
    @endif
</x-layout>