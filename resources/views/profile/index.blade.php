<x-layout>
    {{-- @if(isset($users))
    USERS :
        @foreach ($users as $first_name )
            @if($first_name !== auth()->user()->first_name)
                <br/> <a href="{{ route('profile.show',$first_name) }}">{{ $first_name }}</a>
            @endif
        @endforeach
    @endif --}}
    PROFILE
    {{-- {{ dd(auth()->user()->followers) }} --}}
    {{-- {{ dd(auth()->user()->followers()->pluck('first_name')->toArray()) }} --}}

    <img style="width:100px; height:100px;" src="{{ auth()->user()->getProfilePictureUrl() }}" alt="Uploaded Image">
        <x-form.form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image">
            <button type="submit">Upload</button>
        </x-form.form>
    <select name="follower_id">
        @foreach (auth()->user()->following()->pluck('first_name')->toArray() as $follower)
            <option value="{{ $follower }}">{{ $follower }}</option>
        @endforeach
    </select>
    <br>
    Following: {{ auth()->user()->following()->count() }}
    <br>
    Followers: {{ auth()->user()->followers()->count() }}
    <a href="{{ route('post.create') }}">Create Post</a>
    @if(count(auth()->user()->posts) > 0)
        @foreach (auth()->user()->posts as $post)
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
        <p>NO POST YET</p>
    @endif
</x-layout>