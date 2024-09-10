document.addEventListener('DOMContentLoaded', () => {
    const menuIcon = document.querySelector('.menu-icon');
    const navList = document.querySelector('.nav-list');
    
    menuIcon.addEventListener('click', () => {
        navList.classList.toggle('active');
    });

    const images = document.querySelectorAll('.image-slider img');
    let currentImageIndex = 0;

    function showNextImage() {
        images[currentImageIndex].style.display = 'none';
        currentImageIndex = (currentImageIndex + 1) % images.length;
        images[currentImageIndex].style.display = 'block';
    }

    setInterval(showNextImage, 3000);
});
