<x-layout>
    <a href="{{ route('post.create') }}">Create Post</a>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
        @if(count($post->tags) > 0)
        <p>  Tag/s : 
            @foreach ($post->tags as $tag)
               {{ $tag->name }}
            @endforeach
        </p>
        @endif
        <p>{{ $post['title'] }}</p>
        <p>{{ $post['description'] }}</p>
        <p>{{ ($post['is_published']) ? 'Published' : 'Pending' }}</p>
        <a href="{{ route('post.show',$post['id']) }}">Show</a>
        @endforeach
    @else
        EMPTY
    @endif
</x-layout>