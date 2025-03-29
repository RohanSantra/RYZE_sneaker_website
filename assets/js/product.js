import { quantityData, navigateToProductPage, addToCart,redirectToCheckout } from "./utility.js";


// const timepass = () => {
//     console.log( document.querySelector('input[type="radio"]:checked').value)
   

//     // radioButtons.forEach(radio => {
//     //     radio.addEventListener('change', () => {
//     //         console.clear(); // Clears the console for better visibility of the latest selection

//     //         console.log(`Selected Value: ${radio.value}`);
//     //     });
//     // });
// };

// // Call the function
// timepass();

function individualAddToCart() {
    const button = document.querySelector('.add-to-cart-button');

    button.addEventListener('click', () => {
        const productID = button.getAttribute('data-product-id');
        const productElement = document.querySelector(".Product");
        const size = productElement.querySelector('input[type="radio"]:checked').value;
        const quantity = productElement.querySelector('.number').value;
        
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
        .then(window.location.reload())

    });
}




// updateData();
redirectToCheckout();
quantityData(".products");
quantityData(".Product");
navigateToProductPage(".products");
individualAddToCart();
addToCart(".products");