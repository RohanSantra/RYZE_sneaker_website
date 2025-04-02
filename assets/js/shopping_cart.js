import { quantityData } from "./utility.js";


function toggleProductEditMode() {
    document.querySelectorAll(".update-btn").forEach(updateButton => {
        updateButton.addEventListener("click", function () {
            const product = this.closest(".product");

            const sizeQuantity1 = product.querySelector(".product-size-quantity-container-1");
            const sizeQuantity2 = product.querySelector(".product-size-quantity-container-2");
            const saveButton = product.querySelector(".save-btn");

            sizeQuantity1.style.display = "flex";
            sizeQuantity2.style.display = "none";

            this.style.display = "none";
            saveButton.style.display = "block";
        });
    });

    document.querySelectorAll(".save-btn").forEach(saveButton => {
        saveButton.addEventListener("click", function () {
            const product = this.closest(".product");
            const cartItemID = this.getAttribute("data-cart-item-id"); // Get cart item ID
            const selectedSize = product.querySelector(".product-size").value; // Get selected size
            const quantity = product.querySelector(".number").value; // Get updated quantity

            // Send AJAX request to update size and quantity
            fetch("../../api/user/update_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `cartItemID=${cartItemID}&size=${selectedSize}&quantity=${quantity}`
            }).then(window.location.reload());

            const sizeQuantity1 = product.querySelector(".product-size-quantity-container-1");
            const sizeQuantity2 = product.querySelector(".product-size-quantity-container-2");
            const updateButton = product.querySelector(".update-btn");

            sizeQuantity1.style.display = "none";
            sizeQuantity2.style.display = "flex";

            this.style.display = "none";
            updateButton.style.display = "block";
        });
    });
}

function removeItem(){
    document.querySelectorAll(".remove-btn").forEach(removeButton => {
        removeButton.addEventListener("click", function () {
            const cartItemID = this.getAttribute("data-cart-item-id");
            const productElement = this.closest(".product");
    
    
            fetch("../../api/user/remove_from_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `cartItemID=${cartItemID}`
            })
                .then(window.location.reload())
        });
    });
}


function redirectToShippingPage() {
    const checkoutButton = document.querySelector(".checkout-link");
    const cartQuantityElement = document.querySelector(".cart-quantity");

    // Ensure cartQuantityElement exists before proceeding
    if (!cartQuantityElement || !checkoutButton) return;

    const cartQuantity = parseInt(cartQuantityElement.textContent.trim(), 10) || 0;

    // Disable button if cart is empty
    if (cartQuantity > 0) {
        checkoutButton.removeAttribute("disabled");
        checkoutButton.classList.remove("disable"); // Remove disabled class
    } else {
        checkoutButton.setAttribute("disabled", "true");
        checkoutButton.classList.add("disable"); // Add disabled class
    }

    // Add event listener to navigate only if cart is not empty
    checkoutButton.addEventListener("click", () => {
        if (cartQuantity > 0) {
            window.location.href = "Shipping.php";
        }
    });
}

function redirectToproductsPage(){
    const shopButton=document.querySelectorAll(".shop-btn");
    shopButton.forEach(shop => {
        shop.addEventListener('click',()=>{
            window.location.href='../Products.php';
    });
    });
}


redirectToShippingPage();
toggleProductEditMode();
quantityData(".product");
removeItem();
redirectToproductsPage();


