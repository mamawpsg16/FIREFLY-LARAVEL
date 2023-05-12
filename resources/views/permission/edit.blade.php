<x-layout>
    <x-form.form method="POST" action="{{ route('permission.update',$permission['id']) }}">
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $permission['name'] }}" required>
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>