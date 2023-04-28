<x-layout>
    <a href="{{ route('tag.create') }}">Create Tag</a>
    @if(count($tags) > 0)
        @foreach ($tags as $tag)
        <p>{{ $tag['name'] }}</p>
        <p>{{ $tag['description'] }}</p>
        <a href="{{ route('tag.show',$tag['id']) }}">Show</a>
        @endforeach
    @else
        EMPTY
    @endif
</x-layout>