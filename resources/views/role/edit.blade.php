<x-layout>
    <x-form.form method="POST" action="{{ route('role.update',$role['id']) }}">
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $role['name'] }}" required>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>