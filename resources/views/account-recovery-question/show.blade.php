<x-layout>
    <a href="{{ route('question.index') }}">Home</a>
    <p>{{ $question['question'] }}</p>
    <a href="{{ route('question.edit',$question['id']) }}">Edit</a>
    <x-form.form method="POST" action="{{ route('question.destroy',$question['id']) }}">
        @method('DELETE')
        <button type="submit">Delete</button>
    </x-form.form>
</x-layout>