// import { quantityData,navigateToProductPage } from "./products.js";

// const updateData = () => {
//     const minus = document.querySelector(".Product .minus-number");
//     const add = document.querySelector(".Product .add-number");
//     let quantity = document.querySelector(".Product .number");

//     const minimum = 1;

//     quantity.addEventListener('change', function () {
//         let value = parseInt(quantity.value);

//         if (isNaN(value) || quantity.value.trim() === '' || value <= 0) {
//             quantity.value = 1;
//             return;
//         }

//         if (value > 5) {
//             quantity.value = 5;
//         }
//     });

//     minus.addEventListener("click", function () {
//         if (parseInt(quantity.value) <= minimum) {
//             minus.disabled = true;
//             return;
//         } else {
//             minus.disabled = false;
//         }
//         quantity.value = parseInt(quantity.value) - 1;
//     });

//     add.addEventListener("click", function () {
//         if (parseInt(quantity.value) >= minimum) {
//             minus.disabled = false;
//         }
//         if (parseInt(quantity.value) === 5) {
//             add.disabled = true;
//         }
//         else {
//             add.disabled = false;
//             quantity.value = parseInt(quantity.value) + 1;
//         }
//     });
// }
const quantityData = (product) => {
    document.querySelectorAll(product).forEach(product => {
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
const navigateToProductPage = () => {
    document.querySelectorAll('.products').forEach(product => {
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

// updateData();
quantityData(".products");
quantityData(".Product");
navigateToProductPage();