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
            <input type="password" name="password" value="{{ old('password') }}" required>
        </div>
        <button type="submit">Register </button>
    </x-form.form>
</x-layout>