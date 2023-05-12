<x-layout>
    <x-form.form method="POST" action="{{ route('permission.store') }}">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>