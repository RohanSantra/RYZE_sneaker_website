function slider() {
    // Select elements
    const carouselList = document.querySelector('.carousel .list');
    const items = document.querySelectorAll('.carousel .item');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const indicators = document.querySelectorAll('.indicators li');

    // Variables
    let currentIndex = 0;
    const totalItems = items.length;
    let autoSlideInterval;

    // Function to trigger animations
    function triggerAnimations() {
        const activeItem = items[currentIndex];
        const animatedElements = activeItem.querySelectorAll('.animate-on-slide');

        // Remove and re-add the animation classes to trigger them
        animatedElements.forEach((el) => {
            el.classList.remove('animate');
            // Use a short timeout to allow re-adding the class
            setTimeout(() => el.classList.add('animate'), 10);
        });
    }


    // Function to update the active slide
    function updateSlide() {
        // Calculate the transform value
        const translateXValue = -currentIndex * 100;

        // Apply the transform to the carousel list
        carouselList.style.transform = `translateX(${translateXValue}%)`;

        // Update the active indicator
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentIndex);
        });
        triggerAnimations();
    }

    // Function to reset the interval
    function resetInterval() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalItems;
            updateSlide();
        }, 5000); // Slides every 5 seconds
    }

    // Event listeners for navigation
    prevButton.addEventListener('click', () => {
        // Decrease the index and loop if necessary
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        updateSlide();
        resetInterval(); // Reset the auto-slide interval
    });

    nextButton.addEventListener('click', () => {
        // Increase the index and loop if necessary
        currentIndex = (currentIndex + 1) % totalItems;
        updateSlide();
        resetInterval(); // Reset the auto-slide interval
    });

    // Event listeners for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            currentIndex = index;
            updateSlide();
            resetInterval(); // Reset the auto-slide interval
        });
    });

    // Auto-slide
    resetInterval(); // Start the auto-slide interval initially
    triggerAnimations();
}



function redirectionTOProduct() {
    const views = document.querySelectorAll('.view');
    views.forEach(view => {
        view.addEventListener('click', () => {
            window.location.href = 'Products.php';
        })
    });
}




export function quantityData() {
    document.querySelectorAll(".product").forEach(product => {
        const minus = product.querySelector(".minus-number");
        const add = product.querySelector(".add-number");
        let quantity = product.querySelector(".number");

        const minimum = 1;

        quantity.addEventListener('change', function () {
            let value = parseInt(quantity.value);

            if (isNaN(value) || quantity.value.trim() === '' || value <= 0) {
                quantity.value = 1;
                return;
            }

            if (value > 5) {
                quantity.value = 5;
            }
        });

        minus.addEventListener("click", function () {
            if (parseInt(quantity.value) <= minimum) {
                minus.disabled = true;
                return;
            } else {
                minus.disabled = false;
            }
            quantity.value = parseInt(quantity.value) - 1;
        });

        add.addEventListener("click", function () {
            if (parseInt(quantity.value) >= minimum) {
                minus.disabled = false;
            }
            if (parseInt(quantity.value) === 5) {
                add.disabled = true;
            }
            else {
                add.disabled = false;
                quantity.value = parseInt(quantity.value) + 1;
            }

        });
    });
}



function redirectionTOProductWithCategory() {
    const categoryButtons = document.querySelectorAll('button[data-category]');

    // Add click event listener to each button
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.getAttribute('data-category'); // Get the category from data attribute
            const productsPageUrl = `Products.php?category=${encodeURIComponent(category)}`; // Append category to URL
            window.location.href = productsPageUrl; // Redirect to the products page
        });
    });
}

const navigateToProductPage = () => {
    document.querySelectorAll('.product').forEach(product => {
        product.addEventListener('click', function (event) {
            const productID = product.getAttribute('data-ID');
            // Check if the clicked element is inside interactive elements
            if (
                event.target.closest('.product-quantity-container') ||  // Quantity Input
                event.target.closest('.product-size-container') ||  // Size Dropdown
                event.target.closest('.add-to-cart-button')  // Add to Cart Button
            ) {
                return; // Do nothing if clicking interactive elements
            }

            // Redirect only if clicking on the product itself (not interactive elements)
            window.location.href = `product.php?ID=${encodeURIComponent(productID)}`;
        });
    });

}

document.addEventListener("DOMContentLoaded", () => {
    slider();
    redirectionTOProduct();
    quantityData();
    redirectionTOProductWithCategory();
    navigateToProductPage();
});


