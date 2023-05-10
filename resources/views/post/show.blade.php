<x-layout>
    <a href="{{ route('post.index') }}">Home</a>
    @if($tags)
        <p>
            Tag/s : {{ $tags }}
        </p>
    @endif
    <p>{{ $post['title'] }}</p>
    <p>{{ $post['description'] }}</p>
    <p>{{ ($post['is_published']) ? 'Published' : 'Pending' }}</p>
    @can('update', $post)
    <a href="{{ route('post.edit',$post['id']) }}">Edit</a>
    @endcan
    @can('delete', $post)
        <x-form.form method="POST" action="{{ route('post.destroy',$post['id']) }}">
            @method('DELETE')
            <button type="submit">Delete</button>
    </x-form.form>
    @endcan
</x-layout>