<x-layout>
    <a href="{{ route('permission.index') }}">Home</a>
    <p>{{ $permission['name'] }}</p>
    <a href="{{ route('permission.edit',$permission['id']) }}">Edit</a>
    <x-form.form method="POST" action="{{ route('permission.destroy',$permission['id']) }}">
        @method('DELETE')
        <button type="submit">Delete</button>
    </x-form.form>
</x-layout>