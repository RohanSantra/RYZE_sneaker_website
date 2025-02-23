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


