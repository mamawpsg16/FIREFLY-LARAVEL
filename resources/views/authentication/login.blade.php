<x-layout>
    {{-- LOOP ALL THE ERRORS  --}}
    @if($errors->any())
        <div style="color:red">
                @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p> 
                @endforeach
        </div>
    @endif
    {{-- DISPLAY ERROR ONE BY ONE  --}}
        {{-- @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}
    <x-form.form method="POST" action="{{ route('login.authenticate') }}">
        <div>
            <label for="last_name">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @if($errors->has('email'))
                <div style="color:red">{{ $errors->first('email') }}</div>
            @endif

        </div>
        <div>
            <label for="last_name">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" required class="password">
        </div>
        <label for="show_password">Show Password <input type="checkbox" id="show_password"></label>
        <button type="submit">Login </button>
        <a href="{{ route('forgot-password') }}">Forgot Password?</a>
    </x-form.form>
    <script src="{{ asset('js/show_password.js') }}"></script>
</x-layout>