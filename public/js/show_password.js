// Get the checkbox element and password input element
const showPasswordCheckbox = document.querySelector('#show_password');
const passwordInput = document.querySelectorAll('.password');

// Add an event listener to the checkbox
showPasswordCheckbox.addEventListener('change', function() {
    let checkBox = this.checked;
    passwordInput.forEach(function(element){
        if (checkBox) {
            element.type = 'text';
        } else {
            element.type = 'password';
        }
    })
});