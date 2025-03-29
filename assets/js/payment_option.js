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
            // paymentOptions.forEach(opt => {
            //     opt.classList.remove('active');
            //     const dropdownContent = opt.querySelector('.dropdown-content');
            //     if (dropdownContent) dropdownContent.classList.remove('active');
            // });

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


function backToShippingPage(){
    document.querySelector('.shipping-btn').addEventListener('click',()=>{
        window.location.href='./Shipping.php';
    });
}

// function redirectToOrdersPage() {
//     const confirmPurchaseButton = document.querySelector(".confirm-purchase-btn");
//     const cartQuantity = document.querySelector(".cart-quantity").innerHTML;
//     console.log(cartQuantity)

//     // Add event listener to navigate only if cart is not empty
//     confirmPurchaseButton.addEventListener("click", () => {
//         if (cartQuantity == 0) {
//             window.location.href = "../orders.php";
//         }
//     });
// }



function InputshippingData() {
    const shippingCostElement = document.getElementById("shipping-cost");
    const totalAmountElement = document.querySelector(".total-amount");

    // Getting shipping cost from localStorage and converting it to a number
    const shippingCost = parseFloat(localStorage.getItem("selectedShippingCost")) || 0;

    // Extracting base total (removing currency symbol) and converting to number
    const baseTotal = parseFloat(totalAmountElement.textContent.replace(/[^0-9.]/g, "")) || 0;

    // Updating the shipping cost display
    shippingCostElement.innerHTML = `&#8377;${shippingCost.toFixed(2)}`;

    // Updating the total amount (base total + shipping cost)
    totalAmountElement.innerHTML = `&#8377;${(baseTotal + shippingCost).toFixed(2)}`;
}


document.addEventListener("DOMContentLoaded", function () {
    const paymentOptions = document.querySelectorAll(".payment-option input[name='payment-type']");
    const confirmButton = document.querySelector(".confirm-purchase-btn");
    const errorMsg = document.querySelector(".error-msg");
    let paymentMethod='Cash'

    function displayError(message) {
        errorMsg.textContent = message;
        errorMsg.style.display = "block"; // Show error
    }

    function clearError() {
        errorMsg.style.display = "none"; // Hide error
    }

    function handlePaymentSelection() {
        clearError(); // Remove error message when user makes a selection
    }

    paymentOptions.forEach(option => {
        option.addEventListener("change", handlePaymentSelection);
    });

    confirmButton.addEventListener("click", function (event) {
        const selectedPayment = document.querySelector(".payment-option input[name='payment-type']:checked");

        if (!selectedPayment) {
            displayError("⚠️ Please select a payment method.");
            event.preventDefault();
            return;
        }

        const paymentType = selectedPayment.closest(".payment-option").dataset.type;

        if (paymentType === "online") {
            const selectedOnlineOption = document.querySelector(".radio-group input[name='online-app']:checked");
            if (!selectedOnlineOption) {
                displayError("⚠️ Please select an online payment option.");
                event.preventDefault();
                return;
            }
            else{
                paymentMethod=selectedOnlineOption.value;
            }
        }

        if (paymentType === "card") {
            const cardInputs = document.querySelectorAll("#card-details input");
            let allFilled = true;

            cardInputs.forEach(input => {
                if (input.value.trim() === "") {
                    allFilled = false;
                }
            });

            if (!allFilled) {
                displayError("⚠️ Please fill in all card details before proceeding.");
                event.preventDefault();
                return;
            }
            else{
                paymentMethod='Card';
            }
        }

        clearError(); // Hide error after successful validation
        placeOrder(paymentMethod);
    });
});


function placeOrder(paymentMethod) {
    const orderID = "ORD" + Date.now();
    const totalAmount = parseFloat(document.querySelector(".total-amount").textContent.replace(/[^\d.]/g, ""));
    const shippingCharges = parseFloat(localStorage.getItem("selectedShippingCost")) || 0;

    console.log(orderID, totalAmount, paymentMethod, shippingCharges);

    const data = {
        orderID: orderID,
        totalAmount: totalAmount,
        paymentMethod: paymentMethod,
        shippingCharges: shippingCharges
    };

    fetch("../../api/user/process_order.php", {
        method: 'POST',
        body: JSON.stringify(data), // Convert object to JSON
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
        if (result.success) {
            // alert("Order placed successfully!");
            window.location.href = `../order_details.php?orderID=${orderID}`; // Redirect to orders page
        } else {
            // alert("Failed to place order: " + result.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        // alert("Something went wrong. Please try again. Error: " + error.message);
    });
}










backToShippingPage();
InputshippingData();
// redirectToOrdersPage();