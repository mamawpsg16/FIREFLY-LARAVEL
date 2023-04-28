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
            <input type="password" name="password" value="{{ old('password') }}" class="password" >
        </div>
        <div>
            <label for="last_name">Password Confirmation</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation ') }}" class="password" >
        </div>
        <div>
            <label for="last_name">Account Recovery Question: </label>
            <select name="question_id" >
                @if(isset($questions))
                    @foreach($questions as $key => $question)
                        <option value="{{ $question->id }}" {{ old('question') === $question->id ? 'selected' : '' }}>{{ $question->question }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div>
            <label for="question_answer">Answer:</label>
            <input type="text" name="question_answer" value="{{ old('question_answer') }}" >
        </div>

        <label for="show_password">Show Password <input type="checkbox" id="show_password"></label>
        
        <button type="submit">Register </button>
    </x-form.form>

    <script src="{{ asset('js/show_password.js') }}"></script>
</x-layout>