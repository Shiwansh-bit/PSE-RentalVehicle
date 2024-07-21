
let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("mySlides");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 4000);
}

// Function to search
function search() {
    const query = document.querySelector('.search-bar input').value;
    alert('Searching for: ' + query);
}

// Function to toggle side menu
function toggleMenu() {
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');
    sideMenu.classList.toggle('active');
    overlay.style.display = sideMenu.classList.contains('active') ? 'block' : 'none';
}