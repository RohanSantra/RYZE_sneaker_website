const isSignUpPage = localStorage.getItem("isSignUpPage") === "true"; // Get stored value


const container = document.querySelector('.container');
const signupbtn = document.querySelector('.signup-btn');
const loginbtn = document.querySelector('.login-btn');

// Function to set the active state in localStorage
function setActiveState(isActive) {
    localStorage.setItem('isActive', isActive ? 'true' : 'false');
}

// Check localStorage and apply the active class if necessary
document.addEventListener('DOMContentLoaded', () => {
    const isActive = localStorage.getItem('isActive') === 'true';
    if (isActive) {
        container.classList.add('active');
    } else {
        container.classList.remove('active');
    }
});

//checking to which page it is directed 
if (isSignUpPage) {
    container.classList.add('active');
    setActiveState(true);
}
else {
    container.classList.remove('active');
    setActiveState(false);

}

// Add event listeners for signup and login buttons
signupbtn.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default behavior
    container.classList.add('active');
    setActiveState(true); // Save state to localStorage
});

loginbtn.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default behavior
    container.classList.remove('active');
    setActiveState(false); // Save state to localStorage
});

function togglePassword(passwordFieldId, toggleButton) {
    const passwordField = document.getElementById(passwordFieldId);

    // Toggle the password visibility on button click
    toggleButton.addEventListener('click', function() {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
}

// Get the buttons and attach the toggle function to each password field
document.querySelectorAll('.toggle-password-btn').forEach(button => {
    const passwordFieldId = button.getAttribute('data-target');
    togglePassword(passwordFieldId, button);
});


function toggleLoginToResetPasswordForm() {
    const forgotPassBtn = document.querySelector('.forgot-pass-btn');
    const backToLoginBtn = document.querySelector('.back-to-login-btn');
    const loginForm = document.querySelector('.login-form');
    const passwordResForm = document.querySelector('.password-res-form');

    // Check Local Storage on Page Load
    if (localStorage.getItem("formState") === "resetPassword") {
        loginForm.classList.add('invisible');
        passwordResForm.classList.remove('invisible');
    } else {
        loginForm.classList.remove('invisible');
        passwordResForm.classList.add('invisible');
    }

    // Forgot Password Button Click
    forgotPassBtn?.addEventListener('click', () => {
        loginForm.classList.add('invisible');
        passwordResForm.classList.remove('invisible');
        localStorage.setItem("formState", "resetPassword");
    });

    // Back to Login Button Click
    backToLoginBtn?.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent form submission if it's inside a form
        passwordResForm.classList.add('invisible');
        loginForm.classList.remove('invisible');
        localStorage.setItem("formState", "login");
    });
}

// Initialize the function
document.addEventListener("DOMContentLoaded", toggleLoginToResetPasswordForm);




toggleLoginToResetPasswordForm();
