// import { redirectToproductsPage } from "./utility.js";

function redirectToproductsPage() {
    const shopButton = document.querySelector(".shop-btn");
    shopButton.addEventListener('click', () => {
        window.location.href = '../Products.php';
    })
}


function toggleAdressForm() {
    document.querySelector(".Edit-address-btn").addEventListener("click", function () {
        document.querySelector("#shipping-details").classList.add("hidden");
        document.querySelector("#shipping-form").classList.remove("hidden");

    });
    // document.querySelector(".save-btn").addEventListener('click',()=>{
    //     document.querySelector(".shipping-charges").classList.remove("hidden");
    //     document.querySelector("#shipping-form").classList.remove("hidden");

    // });
}

function changingShippingValue() {
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




function redirectToPaymentPage() {
    const paymentButton = document.querySelector(".payment-link");
    const cartQuantityElement = document.querySelector(".cart-quantity");

    // Ensure cartQuantityElement exists before proceeding
    if (!cartQuantityElement || !paymentButton) return;

    const cartQuantity = parseInt(cartQuantityElement.textContent.trim(), 10) || 0;

    // Disable button if cart is empty
    if (cartQuantity > 0) {
        paymentButton.removeAttribute("disabled");
        paymentButton.classList.remove("disable"); // Remove disabled class
    } else {
        paymentButton.setAttribute("disabled", "true");
        paymentButton.classList.add("disable"); // Add disabled class
    }

    // Add event listener to navigate only if cart is not empty
    paymentButton.addEventListener("click", () => {
        if (cartQuantity > 0) {
            window.location.href = "Payment.php";
        }
    });
}






toggleAdressForm();
redirectToproductsPage();
changingShippingValue();
redirectToPaymentPage();