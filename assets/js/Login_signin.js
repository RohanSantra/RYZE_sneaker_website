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