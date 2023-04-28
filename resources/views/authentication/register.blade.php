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
    <x-form.form method="POST" action="{{ route('register.store') }}">
        <div>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" >
        </div>
        <div>
            <label for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" value="{{ old('middle_name') }}">
        </div>
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" >
        </div>
        <div>
            <label for="last_name">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" >
        </div>
        <div>
            <label for="last_name">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" >
        </div>
        <div>
            <label for="last_name">Password Confirmation</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation ') }}" >
        </div>
        <button type="submit">Register </button>
    </x-form.form>
</x-layout>