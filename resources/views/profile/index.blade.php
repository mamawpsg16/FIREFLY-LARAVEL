<x-layout>
    @if(isset($users))
    USERS :
        @foreach ($users as $first_name )
            @if($first_name !== auth()->user()->first_name)
                <br/> <a href="{{ route('profile.show',$first_name) }}">{{ $first_name }}</a>
            @endif
        @endforeach
    @endif
    PROFILE
    <img style="width:100px; height:100px;" src="{{ auth()->user()->getProfilePictureUrl() }}" alt="Uploaded Image">

    <x-form.form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">Upload</button>
    </x-form.form>
    Following: {{ auth()->user()->following()->count() }}
    <br>
    Followers: {{ auth()->user()->followers()->count() }}
</x-layout>