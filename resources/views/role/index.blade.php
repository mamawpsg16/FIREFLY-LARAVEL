<x-layout>
    <a href="{{ route('role.create') }}">Create Role</a>
    @if(count($roles) > 0)
        @foreach ($roles as $role)
        <p>{{ $role['name'] }}</p>
        <a href="{{ route('role.show',$role['id']) }}">Show</a>
        @endforeach
    @else
        EMPTY
    @endif
</x-layout>