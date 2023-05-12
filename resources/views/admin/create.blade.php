<x-layout>
    <x-form.form method="POST" action="{{ route('admin.store') }}" id="submit">
        <input type="text" name="search-user" id="search-user">
        <label for="users">Users </label>
        <select id="select-user" name="select_user">
            @if(isset($users))
                @foreach($users as $key => $user)
                    <option value="{{ $user['id'] }}" {{ old('select_user') === $user['id'] ? 'selected' : '' }}>{{ $user['email'] }}</option>
                @endforeach
            @endif
        </select>
        <label for="role">Roles </label>
        <select id="select-role" name="select_role">
            @if(isset($roles))
                @foreach($roles as $key => $role)
                    <option value="{{ $role['id'] }}" {{ old('select_user') === $role['id'] ? 'selected' : '' }}>{{ $role['name'] }}</option>
                @endforeach
            @endif
        </select>
        @if(count($modules) > 0)
            @foreach($modules as $module)
                <div style="margin:15px 0;">
                    <label for="">{{ $module['name'] }} - </label>
                    @if(count($permissions) > 0)
                        @foreach ($permissions as $permission)
                        {{-- {{ dd($permission['name']) }} --}}
                            <label for="{{ $module['name'] }}{{ $permission['name'] }}">{{ $permission['name'] }}<input type="checkbox" name="{{ $module['name'] }}[]" id="{{ $module['name'] }}{{ $permission['name'] }}" value="{{ $permission['id'] }}"></label>
                        @endforeach
                        <label for="{{ $module['name'] }}_all">All <input type="checkbox" id="{{ $module['name'] }}_all" class="crud" value="crud"></label>
                    @endif
                </div>
            @endforeach
        @endif
        <button type="submit">Save</button>
    </x-form.form>
    <script>

        
        // const debounce = function(callback, delay) {
        //     let timeout;
        //     return function() {
        //         clearTimeout(timeout);
        //         timeout = setTimeout(callback, delay);
        //     }
        // }
        let all = document.getElementsByClassName('crud');
            for (let i = 0; i < all.length; i++) {
                all[i].addEventListener('click', function(e) {
                    let parentDiv = this.closest('div');
                    let checkboxes = parentDiv.querySelectorAll('input[type="checkbox"]');
                    let allChecked = this.checked;
                    for (let j = 0; j < checkboxes.length; j++) {
                        checkboxes[j].checked = allChecked;
                    }
            });
        }
        let search_user = document.querySelector('#search-user');
        search_user.addEventListener('change',function(e){
            // const httpRequest = new XMLHttpRequest();
            // let formData = new FormData(this);
            // formData.append('id', profile_user_id);
            // var url = "/profile/toggleFollow";
            // httpRequest.open('POST', url);

            // httpRequest.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            // httpRequest.send(formData);
            // debounce(function(){

            // },400)
        });
        document.getElementById('submit').addEventListener('submit',function(e){
            e.preventDefault();
            const httpRequest = new XMLHttpRequest();
            let formData = new FormData(this);
            // formData.append('id', profile_user_id);
            var url = '{{ route('admin.store') }}';
            httpRequest.open('POST', url);

            httpRequest.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            httpRequest.send(formData);
           
        })


    </script>
</x-layout>