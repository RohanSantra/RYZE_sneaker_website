

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

// export function addToCart(productClassType) {
//     document.querySelectorAll('.add-to-cart-button').forEach(button => {
//         button.addEventListener('click', () => {
//             const productID = button.getAttribute('data-product-id');
//             const productElement = button.closest(productClassType);

//             let size = "";
//             const sizeDropdown = productElement.querySelector('.product-size');

//             if (sizeDropdown && sizeDropdown.tagName === "SELECT") {
//                 // If size selection is a dropdown
//                 size = sizeDropdown.value.trim();
//             } else {
//                 // If size selection is radio buttons (inside productElement)
//                 const selectedRadio = productElement.querySelector('input[name="size"]:checked');
//                 size = selectedRadio.value.trim();
//             }

//             const quantity = productElement.querySelector('.number').value;

//             const data = new URLSearchParams();
//             data.append('product_id', productID);
//             data.append('size', size);
//             data.append('quantity', quantity);

//             // Send the data using fetch API
//             fetch('../api/user/add_to_cart.php', {
//                 method: 'POST',
//                 body: data,
//                 headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
//             })
//                 .then(window.location.reload());
//         });
//     });
// }
