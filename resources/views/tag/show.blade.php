<x-layout>
    <a href="{{ route('tag.index') }}">Home</a>
    <p>{{ $tag['name'] }}</p>
    <p>{{ $tag['description'] }}</p>
    <a href="{{ route('tag.edit',$tag['id']) }}">Edit</a>
    <x-form.form method="POST" action="{{ route('tag.destroy',$tag['id']) }}">
        @method('DELETE')
        <button type="submit">Delete</button>
    </x-form.form>
</x-layout>