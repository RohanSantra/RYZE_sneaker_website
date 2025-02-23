export function initializeSidebar() {
    const middleSection = document.querySelector('.middle-section');
    const sideClose = document.querySelector('.side-close');
    const openSidebarButton = document.querySelector('.open-sidebar-button');
    const closeSidebarButton = document.querySelector('.close-sidebar-button');

    if (!middleSection || !sideClose || !openSidebarButton || !closeSidebarButton) {
        console.error("Sidebar elements are not found in the DOM.");
        return;
    }

    // Open sidebar
    openSidebarButton.addEventListener('click', () => {
        middleSection.style.right = '-2%'; // Adjusted to fully open the sidebar
        sideClose.style.display = 'block'; // Show the overlay
    });

    // Close sidebar with close button
    closeSidebarButton.addEventListener('click', () => {
        middleSection.style.right = '-100%'; // Hide the sidebar
        sideClose.style.display = 'none'; // Hide the overlay
    });

    // Close sidebar when clicking outside
    sideClose.addEventListener('click', () => {
        middleSection.style.right = '-100%'; // Hide the sidebar
        sideClose.style.display = 'none'; // Hide the overlay
    });
}

export function navbarToggle() {
    let lastScrollPosition = 0;
    const header = document.querySelector('.header-section');
    const middleSection = document.querySelector('.middle-section');
    const sideClose = document.querySelector('.side-close');

    if (!header) {
        console.error("Header element is not found in the DOM.");
        return;
    }

    window.addEventListener('scroll', () => {
        const currentScrollPosition = window.pageYOffset;

        // Close the sidebar when the window is scrolled
        if (middleSection && sideClose) {
            middleSection.style.right = '-100%';
            sideClose.style.display = 'none';
        }

        if (currentScrollPosition > lastScrollPosition) {
            // Scrolling down: Hide header
            header.classList.add('header-hidden');
        } else {
            // Scrolling up: Show header
            header.classList.remove('header-hidden');
        }

        // Update the last scroll position
        lastScrollPosition = currentScrollPosition;
    });
}

export function dropdown() {
    const userDropdown = document.querySelector(".user-dropdown");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    if (dropdown && userDropdown) {
        window.addEventListener('scroll', () => {
            if (dropdown) {
                dropdownMenu.style.display = "none";
            }
        });
        // Toggle dropdown on click
        userDropdown.addEventListener("click", (event) => {
            event.stopPropagation(); // Prevent event from propagating to document
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        // Close the dropdown if clicked outside
        document.addEventListener("click", () => {
            dropdownMenu.style.display = "none";
        });
    }



}
function redirectionToLoginSignUpPage() {

    // Get the login and signup buttons
    const loginBtn = document.querySelectorAll(".login-btn");
    const signupBtn = document.querySelectorAll(".signup-btn");


    loginBtn.forEach(loginElement => {
        if (loginElement) {
            loginElement.addEventListener("click", function () {
                localStorage.setItem("isSignUpPage", "false");
                window.location.href = "../public/Login_Signup.php"; // Redirect to login/signup page
            });
        }
    });

    signupBtn.forEach(signUpElement => {
        if (signUpElement) {
            signUpElement.addEventListener("click", function () {
                localStorage.setItem("isSignUpPage", "true");
                window.location.href = "../public/Login_Signup.php"; // Redirect to login/signup page
            });
        }
    });


}



// Initialize functions after DOM content is loaded
document.addEventListener("DOMContentLoaded", () => {
    initializeSidebar();
    navbarToggle();
    redirectionToLoginSignUpPage();
    dropdown();

});
