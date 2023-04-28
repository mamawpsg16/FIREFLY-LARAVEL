<nav>
    <ul>
      <li><a href="/" class="nav-link">Home</a></li>
      @auth
        <li><a href="{{ route('profile') }}" class="nav-link">Profile</a></li>
        <li><a href="#" class="nav-link">Welcome, {{ auth()->user()->first_name }}</a></li>
        <li><a href="{{ route('register.create') }}" class="nav-link">Register</a></li>
        <x-form.form method="POST" action="{{ route('logout') }}">
          <button type="submit">Logout </button>
        </x-form.form>
      @else
        <li><a href="{{ route('login.create') }}" class="nav-link">Login</a></li>
        <li><a href="{{ route('register.create') }}" class="nav-link">Register</a></li>
      @endauth
    </ul>
  </nav>
  