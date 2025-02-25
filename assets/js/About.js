import { initializeSidebar, navbarToggle } from "./header.js";

// initializing the Sidebar
initializeSidebar();
navbarToggle();


/**
 * This function implements a scroll-based animation trigger for elements with the class 'autoshow'.
 * 
 * Detailed Explanation:
 * 1. **Event Listener Setup**:
 *    - The `DOMContentLoaded` event ensures that the script runs only after the HTML document is fully loaded and parsed.
 * 
 * 2. **Selecting Elements**:
 *    - The `querySelectorAll` method is used to select all elements with the class `autoshow`.
 *    - These elements are stored in the `elements` variable for later processing.
 * 
 * 3. **Scroll Handling**:
 *    - The `handleScroll` function checks the position of each `.autoshow` element relative to the viewport.
 *    - It uses `getBoundingClientRect` to determine the element's position.
 *    - If the top of the element is within 80% of the viewport height (`rect.top < window.innerHeight * 0.8`) and the bottom of the element is still above the top of the viewport (`rect.bottom > 0`), the element is considered visible.
 *    - When the element is visible, the class `visible` is added, likely triggering an animation or style change.
 *    - If the element moves out of view, the `visible` class is removed to ensure the effect is reversed.
 * 
 * 4. **Event Attachment**:
 *    - The `handleScroll` function is attached to the `scroll` event on the `window` object, ensuring that visibility is checked whenever the user scrolls.
 * 
 * 5. **Initial Trigger**:
 *    - `handleScroll` is called once immediately to ensure elements already in view are correctly handled when the page loads.
 */

(function () {
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('.autoshow');

        const handleScroll = () => {
            elements.forEach(element => {
                const rect = element.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.9 && rect.bottom > 0) {
                    element.classList.add('visible');
                } else {
                    element.classList.remove('visible'); // Ensure the class is removed if out of view
                }
            });
        };

        // Attach the scroll event listener
        window.addEventListener('scroll', handleScroll);

        // Trigger animation once on page load
        handleScroll();
    })
})();
