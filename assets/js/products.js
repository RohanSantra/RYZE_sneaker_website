import { quantityData, navigateToProductPage, addToCart,redirectToCheckout } from "./utility.js";

const selectValueFromURL = () => {
    // Example: Get value from the URL (e.g., ?category=Men)
    let urlParams = new URLSearchParams(window.location.search);
    let categoryValue = urlParams.get('category') || "All"; // Default to "All" if no category is found

    // Set the selected value in the dropdown
    document.getElementById('category-dropdown').value = categoryValue;

}

export const fetchCategoryData = () => {
    const dropdown = document.getElementById('category-dropdown');
    dropdown.addEventListener('change', function () {
        var selectedCategory = this.value;

        fetch('./../includes/fetch_products.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'category=' + encodeURIComponent(selectedCategory)
        })
            .then(response => response.text())
            .then(data => {
                document.querySelector('.products-container').innerHTML = data;
                navigateToProductPage(".product");
                quantityData(".product");
                addToCart(".product");
            })
            .catch(error => console.error('Error:', error));
    });
}

// function redirectToCheckout(){
//     document.querySelectorAll('.add-to-cart-button').forEach(button => {
//         button.addEventListener('click', () => {
//             gettingUserID();
//         });
//     });
// }





document.addEventListener("DOMContentLoaded", () => {
    redirectToCheckout();
    selectValueFromURL();
    fetchCategoryData();
    quantityData(".product");
    navigateToProductPage(".product");
    addToCart(".product");
});




