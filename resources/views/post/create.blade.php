<x-layout>
    <x-form.form method="POST" action="{{ route('post.store') }}">
        <label for="Tags">Tags</label>
        <select name="tags[]" multiple required>
            @foreach($tags as $key => $tag)
                <option value="{{ $tag->id }}" {{ old('tags') === $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" required>
        <label for="description">Description</label>
        <textarea name="description" id="" cols="5" rows="5"  value="{{ old('description') }}" required></textarea>
        <label for="title">published</label>
        <input type="checkbox" name="is_published" value="{{ old('is_published') }}">
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>