import { gettingUserID } from "./utility.js";

function addToCart() {
    document.querySelectorAll('.buy-again').forEach(button => {
        button.addEventListener('click', () => {
            gettingUserID();
            const productID = button.getAttribute('data-product-id');
            const size = button.getAttribute('data-product-size');
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
            const quantity = button.getAttribute('data-product-quantity');

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

addToCart();