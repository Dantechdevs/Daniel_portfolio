
// script.js

// Typing effect
const words = ["Web Developer", "Developer", "Web Designer", "Youtuber", "Script Writer"];
let wordIndex = 0;
let letterIndex = 0;
let currentWord = "";
let isDeleting = false;
const typingElement = document.querySelector(".typing-text span");

function type() {
    if (!typingElement) return;

    currentWord = words[wordIndex];
    if (isDeleting) {
        typingElement.textContent = currentWord.substring(0, letterIndex--);
    } else {
        typingElement.textContent = currentWord.substring(0, letterIndex++);
    }

    if (!isDeleting && letterIndex === currentWord.length) {
        isDeleting = true;
        setTimeout(type, 1000);
    } else if (isDeleting && letterIndex === 0) {
        isDeleting = false;
        wordIndex = (wordIndex + 1) % words.length;
        setTimeout(type, 500);
    } else {
        setTimeout(type, isDeleting ? 50 : 100);
    }
}

document.addEventListener("DOMContentLoaded", type);

// Burger menu toggle
document.addEventListener("DOMContentLoaded", () => {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector("nav");
    burger.addEventListener("click", () => {
        nav.classList.toggle("show");
    });
});
