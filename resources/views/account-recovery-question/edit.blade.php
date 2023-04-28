<x-layout>
    <x-form.form method="POST" action="{{ route('question.update',$question['id']) }}">
        @method('PUT')
        <label for="question">Question</label>
        <input type="text" name="question" value="{{ $question['question'] }}" required>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>