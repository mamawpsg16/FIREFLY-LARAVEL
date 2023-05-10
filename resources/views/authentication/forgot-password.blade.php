<x-layout>
    <x-form.form method="POST" id="my-form">
        <div>
            <label for="last_name">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required id="email">
            @error('email')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <button type="button" id="verify">Verify</button>
        {{-- <a href="{{ route('forgot-password') }}">Forgot Password?</a> --}}
    </x-form.form>
    <x-form.form method="POST">
        <div style="display:none" id="question-container">
            <p id="account-recovery-question"></p>
            <label for="question_answer">Answer</label>
            <input type="text" name="question_answer" value="{{ old('question_answer ') }}" id="question_answer">
            <button id="submit-answer" type="button">Submit</button>
        </div>
    </x-form.form>
    <x-form.form method="POST">
        <div style="display:none" id="reset-password-container">
            <label for="password">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" class="password">
            <br>
            <label for="last_name">Password Confirmation</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation ') }}"
                class="password">
            <br>
            <label for="show_password">Show Password <input type="checkbox" id="show_password"></label>
            <button type="button" id="reset-password">Reset</button>
        </div>
    </x-form.form>
    <script>
        document.getElementById('verify').addEventListener('click', function(event) {
            event.preventDefault();
            let email = document.querySelector('#email').value;
            //    var formData = new FormData(this);
            //    formData.append('question_answer', answer);
            email = email ? email : 'null'
            var xhr = new XMLHttpRequest();
            var url = "/account-recovery/" + email;
            console.log(url);
            xhr.open('POST', url);


            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send();

            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    let email_error = document.querySelector('#email-error');
                    var response = JSON.parse(this.responseText);
                    if (response.is_user_exist) {
                        document.getElementById('question-container').style.display = 'block';
                        console.log(response);
                        document.getElementById('account-recovery-question').innerHTML = response.question;

                        if (email_error) {
                            email_error.remove();
                        }

                    } else {
                        document.getElementById('question-container').style.display = 'none';
                        if (email_error) {
                            email_error.remove();
                        }
                        // Create a new paragraph element
                        const newParagraph = document.createElement('p');

                        newParagraph.setAttribute('id', 'email-error');

                        // Add some text to the paragraph element
                        const paragraphText = document.createTextNode('Email doesnt exists!');

                        newParagraph.appendChild(paragraphText);

                        // Find an existing div element to append the new paragraph element to
                        const existingDiv = document.getElementById('email');

                        existingDiv.insertAdjacentElement('afterend', newParagraph);
                        // Append the new paragraph element to the existing div element

                    }
                    if (response.is_correct_answer) {
                        document.getElementById('reset-password-container').style.display = 'block';
                    }
                    // console.log(response.is_user_exist,this.responseText);
                }
            };
        });
        document.getElementById('submit-answer').addEventListener('click', function(event) {
            console.log('SUBMIT');
            //  return false;
            event.preventDefault();
            let answer = document.querySelector('#question_answer').value;
            let email = document.querySelector('#email').value;
            //    var formData = new FormData(this);

            // Create a new FormData object
            // Create a new FormData object
            var formData = new FormData();
            formData.append('question_answer', answer ? answer : '');
            formData.append('email', email ? email : 'null');

            // Send the AJAX request
            var xhr = new XMLHttpRequest();
            var url = "/account-recovery/verify/answer";
            xhr.open('POST', url);

            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(formData);

            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    let email_error = document.querySelector('#email-error');
                    var response = JSON.parse(this.responseText);
                    console.log(response);
                    if (response.is_correct_answer) {
                        document.getElementById('reset-password-container').style.display = 'block';
                    }
                    // console.log(response.is_user_exist,this.responseText);
                }
            };
        });
        document.getElementById('reset-password').addEventListener('click', function(event) {
            console.log('RESET');
            //  return false;
            event.preventDefault();
            let email = document.querySelector('#email').value;
            let password = document.getElementsByName('password')[0].value;
            let password_confirmation = document.getElementsByName('password_confirmation')[0].value;
            //    var formData = new FormData(this);

            // Create a new FormData object
            // Create a new FormData object
            var formData = new FormData();
            formData.append('password', password ? password : '');
            formData.append('password_confirmation', password_confirmation ? password_confirmation : '');
            formData.append('email', email ? email : 'null');

            // Send the AJAX request
            var xhr = new XMLHttpRequest();
            var url = "/account-recovery/change-password/reset";
            xhr.open('POST', url);

            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.addEventListener('load', function() {
                if (xhr.status === 200) {
                    // The request was successful
                    console.log(xhr.responseURL);
                    // return false;
                    window.location.href = xhr.responseURL;
                } else {
                    // The request failed
                    console.error(xhr.statusText);
                }
            });
            xhr.send(formData);
        });
    </script>
    <script src="{{ asset('js/show_password.js') }}"></script>
</x-layout>
