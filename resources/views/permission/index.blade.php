<x-layout>
    <a href="{{ route('permission.create') }}">Create Permission</a>
    @if(count($permissions) > 0)
        @foreach ($permissions as $permission)
        <p>{{ $permission['name'] }}</p>
        <a href="{{ route('permission.show',$permission['id']) }}">Show</a>
        @endforeach
    @else
        EMPTY
    @endif
</x-layout>