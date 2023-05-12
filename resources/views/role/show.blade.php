<x-layout>
    <a href="{{ route('role.index') }}">Home</a>
    <p>{{ $role['name'] }}</p>
    <a href="{{ route('role.edit',$role['id']) }}">Edit</a>
    <x-form.form method="POST" action="{{ route('role.destroy',$role['id']) }}">
        @method('DELETE')
        <button type="submit">Delete</button>
    </x-form.form>
</x-layout>