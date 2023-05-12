<nav>
  <ul>
    {{-- {{ dd(auth()->user()->hasPermission()) }} --}}
      <li><a href="{{ route('post.index') }}" class="nav-link">Home</a></li>
      @auth
          <x-form.form id="search-profile">
              <input type="text" name="search" placeholder="Search Profile" value="{{ session('query') }}">
              <button type="submit">Search</button>
            </x-form.form>
            <li><a href="{{ route('profile.index') }}" class="nav-link">Profile</a></li>
            <li style="color:white;">Welcome, {{ auth()->user()->first_name }}</li>
          {{-- <li><a href="{{ route('admin.index') }}" class="nav-link">Users</a></li> --}}
            @if(isset($modules))
                @foreach($modules as $module)
                        @if(in_array($module['id'], array_column($modules_and_permissions, 'module_id')))
                            <li><a href="{{ route(strtolower($module['name'].'.'.'index')) }}" class="nav-link">{{ $module['name'] }}</a> </li>
                        @endif
                 @endforeach
            @endif
          <x-form.form method="POST" action="{{ route('logout') }}">
              <button type="submit">Logout </button>
          </x-form.form>
      @else
          <li><a href="{{ route('login.create') }}" class="nav-link">Login</a></li>
          <li><a href="{{ route('register.create') }}" class="nav-link">Register</a></li>
         
      @endauth
  </ul>
</nav>


<script>
    const searchBtn = document.getElementById('search-profile');
    if(searchBtn){
        searchBtn.addEventListener('submit', function(e) {
            e.preventDefault();
            const httpRequest = new XMLHttpRequest();
            let formData = new FormData(this);
            // httpRequest.setRequestHeader(
            //   'X-CSRF-TOKEN', '{{ csrf_token() }}'
            // );
            // console.log(new URLSearchParams(formData).toString());
            // httpRequest.open("POST", "http://www.example.org/some.file");
            // Open GET request with search route URL and serialized form data as query parameters
            httpRequest.open('GET', '{{ route('profile.search') }}?' + new URLSearchParams(formData).toString(),
                true);
            httpRequest.onload = function() {
                // const response = JSON.parse(httpRequest.responseText);
                if (httpRequest.status === 200) {
                    // Handle successful response from server
                    window.location.href = '{{ route('profile.results') }}';
                } else {
                    alert('Error searching. Please try again.');
                }
            };
            httpRequest.send();
        })
    }
</script>
