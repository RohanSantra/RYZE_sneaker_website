import { initializeSidebar } from "./header.js";

initializeSidebar();

document.querySelectorAll('.faq-item').forEach(item => {
    item.addEventListener('click', () => {
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.faq-question i');
        
        // Toggle visibility of the answer
        answer.style.maxHeight = answer.style.maxHeight ? null : answer.scrollHeight + "px";
        
        // Rotate the icon
        icon.classList.toggle('rotate');
    });
});
