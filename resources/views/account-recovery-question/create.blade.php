<x-layout>
    <x-form.form method="POST" action="{{ route('question.store') }}">
        <label for="question">Question</label>
        <input type="text" name="question" value="{{ old('question') }}" required>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>