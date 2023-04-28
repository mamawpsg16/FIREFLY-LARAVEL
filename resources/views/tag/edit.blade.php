<x-layout>
    <x-form.form method="POST" action="{{ route('tag.update',$tag['id']) }}">
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $tag['name'] }}" required>
        <label for="description">Description</label>
        <textarea name="description" id="" cols="5" rows="5" required>{{ $tag['description'] }}</textarea>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>