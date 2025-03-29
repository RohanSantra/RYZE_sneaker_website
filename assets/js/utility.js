

export const quantityData = (productClassType) => {
    document.querySelectorAll(productClassType).forEach(product => {
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
export const navigateToProductPage = (productClassType) => {
    document.querySelectorAll(productClassType).forEach(product => {
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




export function addToCart(productClassType) {
    document.querySelectorAll('.add-to-cart-button').forEach(button => {
        button.addEventListener('click', () => {
            gettingUserID();
            const productID = button.getAttribute('data-product-id');
            const size = button.closest(productClassType).querySelector('.product-size').value;
            // let size = null;
            // if (sizeElement.tagName === "SELECT") {
            //     // If it's a dropdown select element
            //     size = sizeElement.value.trim();
            // } else {
            //     // If it's a radio button group
            //     let selectedRadio = button.querySelector('input[type="radio"]:checked');
            //     console.log(selectedRadio);
            //     size = selectedRadio.value.trim();
            // }
            const quantity = button.closest(productClassType).querySelector('.number').value;

            const data = new URLSearchParams();
            data.append('product_id', productID);
            data.append('size', size);
            data.append('quantity', quantity);

            // Send the data using fetch API
            fetch('../api/user/add_to_cart.php', {
                method: 'POST',
                body: data,
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
                .then(window.location.reload());
        });
    });
}


export function changingShippingValue() {
    const shippingOptions = document.querySelectorAll(".shipping-option");
    const shippingCostElement = document.getElementById("shipping-cost");
    const totalAmountElement = document.querySelector(".total-amount");

    // Extract base total (removing currency symbol)
    const baseTotal = parseFloat(totalAmountElement.textContent.replace(/[^0-9.]/g, "")) || 0;

    function updateShippingSelection() {
        // Remove 'selected' class from all cards
        document.querySelectorAll(".shipping-option-card").forEach(card => {
            card.classList.remove("selected");
        });

        // Get the checked radio button
        const selectedOption = document.querySelector(".shipping-option:checked");

        if (selectedOption) {
            // Add 'selected' class to the corresponding card
            selectedOption.closest(".shipping-option-card").classList.add("selected");

            // Get the selected shipping price
            const shippingCost = parseFloat(selectedOption.getAttribute("data-price")) || 0;

            // Store shipping cost in localStorage
            localStorage.setItem("selectedShippingCost", shippingCost);

            // Update the shipping cost in UI
            shippingCostElement.innerHTML = `&#8377;${shippingCost.toFixed(2)}`;

            // Update the total amount (base total + shipping)
            totalAmountElement.innerHTML = `&#8377;${(baseTotal + shippingCost).toFixed(2)}`;
        }
    }

    // Attach event listener to all shipping options
    shippingOptions.forEach(option => {
        option.addEventListener("change", updateShippingSelection);
    });

    // Retrieve stored shipping cost from localStorage
    const storedShippingCost = parseFloat(localStorage.getItem("selectedShippingCost")) || 0;

    // If there's a stored shipping cost, set the corresponding option as checked
    shippingOptions.forEach(option => {
        if (parseFloat(option.getAttribute("data-price")) === storedShippingCost) {
            option.checked = true;
        }
    });

    // Run on page load to set the initial state
    updateShippingSelection();
}

export function gettingUserID() {
    fetch('../includes/getUserID.php') // Correct file name
        .then(response => response.json()) // Parse JSON response
        .then(data => {
            if (data.userID) {
                return; 
            } else{
                alert("Please login first to continue");
                window.location.href = "./Login_Signup.php";
                
            }
        })
        .catch(error => console.error('Error:', error));
}

export function redirectToCheckout(){
    document.querySelectorAll('.add-to-cart-button').forEach(button => {
        button.addEventListener('click', () => {
            gettingUserID();
        });
    });
}
