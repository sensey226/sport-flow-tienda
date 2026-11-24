jQuery(document).ready(function () {
    jQuery(".section-content").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
        autoplay: true,
        speed: 500,
        fade: false, // Set this to true if you want fade transitions
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Slick initialization check
    if (typeof jQuery(".section-content").slick === "function") {
        // Add click event to thumbnails
        const thumbnails = document.querySelectorAll("#slider-thumbnails .thumbnail");
        thumbnails.forEach((thumbnail) => {
            thumbnail.addEventListener("click", function () {
                const postId = this.getAttribute("data-post-id"); // Get the post ID of the clicked thumbnail

                // Find the index of the corresponding slider
                const sliderContent = document.querySelectorAll(".section-content article");
                let targetIndex = -1;
                sliderContent.forEach((slide, index) => {
                    if (slide.getAttribute("data-post-id") === postId) {
                        targetIndex = index;
                    }
                });

                // Go to the target slide in Slick
                if (targetIndex !== -1) {
                    jQuery(".section-content").slick("slickGoTo", targetIndex);
                }
            });
        });
    } else {
        console.error("Slick carousel is not initialized. Please check Slick setup.");
    }
});