(function () {
    const paymentOptions = document.querySelectorAll('.payment-option');

    // Add event listener to each payment option
    paymentOptions.forEach(option => {
        const radioInput = option.querySelector('input[type="radio"]');
        const dropdown = option.querySelector('.dropdown-content');

        // Toggle dropdown when clicking on the entire box
        option.addEventListener('click', (event) => {
            // Check if the clicked option is already active
            const isActive = option.classList.contains('active');

            // Reset all options
            paymentOptions.forEach(opt => {
                opt.classList.remove('active');
                const dropdownContent = opt.querySelector('.dropdown-content');
                if (dropdownContent) dropdownContent.classList.remove('active');
            });

            // Toggle the clicked option
            if (!isActive) {
                option.classList.add('active');
                radioInput.checked = true; // Ensure the radio button is selected
                if (dropdown) dropdown.classList.add('active');
            }
        });

        // Prevent dropdown from closing when interacting with its contents
        if (dropdown) {
            dropdown.addEventListener('click', (event) => {
                event.stopPropagation();
            });
        }
    });

    // Close dropdown if clicking outside the box
    document.addEventListener('click', (event) => {
        paymentOptions.forEach(option => {
            if (!option.contains(event.target)) {
                option.classList.remove('active');
                const dropdownContent = option.querySelector('.dropdown-content');
                if (dropdownContent) dropdownContent.classList.remove('active');
            }
        });
    });
})();

console.log("hello")