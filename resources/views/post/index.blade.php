<x-layout>
    <a href="{{ route('post.create') }}">Create Post</a>
    @if(count($posts) > 0)
    @foreach ($posts as $post)
        <p><a href="{{ route('profile.show',$post->user->first_name) }}">{{ $post->user->first_name }} {{ $post->user->middle_name }} ,{{ $post->user->last_name }}</a></p>
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
        @can('view',$post)
            <a href="{{ route('post.show',$post['id']) }}">Show</a>
        @endcan
        @endforeach
    @else
        EMPTY
    @endif
</x-layout>