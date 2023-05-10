<x-layout>
    SHOW 
    <p>Profile:</p>
    {{-- {{ dd($user->followButtonText()) }} --}}
    <img style="width:100px; height:100px;" src="{{ $user->getProfilePictureUrl() }}" alt="">
    {{ $user->first_name  }}
    {{ $user->last_name   }}
    {{-- {{ dd($user->shit()) }} --}}
    <input type="hidden" value="{{ $user->id }}" id="user-id">
    <button type="button" id="toggle-button">{{ $user->followButtonText() }}</button>
    <script>
        const toggleButton = document.getElementById('toggle-button');
        const profile_user_id = document.getElementById('user-id').value;
        toggleButton.addEventListener('click', function(){
            const httpRequest = new XMLHttpRequest();
            let formData = new FormData();
            formData.append('id', profile_user_id);
            var url = "/profile/toggleFollow";
            httpRequest.open('POST', url);

            httpRequest.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            httpRequest.send(formData);
        });
    </script>
</x-layout>