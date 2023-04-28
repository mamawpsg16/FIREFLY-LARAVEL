<x-layout>
    <x-form.form method="POST" action="{{ route('tag.store') }}">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('title') }}" required>
        <label for="description">Description</label>
        <textarea name="description" id="" cols="5" rows="5"  value="{{ old('description') }}" required></textarea>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>