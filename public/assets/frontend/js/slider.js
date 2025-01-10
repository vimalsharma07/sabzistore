$(document).ready(function () {
    // Initialize Slick Slider
    $('.slider').slick({
        dots: false,                // Show dots for navigation
        infinite: false,            // Infinite loop
        speed: 500,                // Transition speed
        slidesToShow: 4,           // Show 4 products at once on larger screens
        slidesToScroll: 1,         // Scroll 1 product at a time
        autoplay: true,            // Enable autoplay
        autoplaySpeed: 3000,       // Autoplay interval in milliseconds
        arrows: true,              // Show arrows for navigation
        responsive: [              // Define breakpoints for responsiveness
            {
                breakpoint: 1024,  // Tablet (below 1024px)
                settings: {
                    slidesToShow: 3,   // Show 3 products
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,   // Mobile (below 768px)
                settings: {
                    slidesToShow: 2,   // Show 2 products
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,   // Mobile (below 576px)
                settings: {
                    slidesToShow: 1,   // Show 1 product
                    slidesToScroll: 1,
                }
            }
        ]
    });
});