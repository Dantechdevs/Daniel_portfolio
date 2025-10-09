// ==============================
// Typing Effect
// ==============================
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

// ==============================
// Responsive Burger Menu
// ==============================
document.addEventListener("DOMContentLoaded", () => {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector("nav");
    const navLinks = document.querySelectorAll("nav a");

    if (burger && nav) {
        // Toggle menu visibility
        burger.addEventListener("click", () => {
            nav.classList.toggle("show");
            burger.classList.toggle("active");
        });

        // Close menu when a link is clicked (for mobile screens)
        navLinks.forEach(link => {
            link.addEventListener("click", () => {
                if (window.innerWidth <= 768) {
                    nav.classList.remove("show");
                    burger.classList.remove("active");
                }
            });
        });
    }
});

// ==============================
// Smooth Scrolling for Nav Links
// ==============================
document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            const target = document.querySelector(link.getAttribute("href"));
            if (target) {
                e.preventDefault();
                window.scrollTo({
                    top: target.offsetTop - 60,
                    behavior: "smooth"
                });
            }
        });
    });
});
