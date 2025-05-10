/**
 * Lazy Loading Images Implementation
 * 
 * This script implements image lazy loading using the Intersection Observer API.
 * It improves page performance by only loading images when they're about to become visible.
 */

// Select all images that have a data-src attribute
const lazyImages = document.querySelectorAll('img[data-src]');

/**
 * Handles lazy loading for a specific image element
 * @param {HTMLImageElement} target - The image element to be lazy loaded
 */
const lazyLoad = (target) => {
    // Create a new Intersection Observer instance
    const io = new IntersectionObserver((entries, observer) => {
        // Process each entry
        entries.forEach(entry => {
            // Check if the image is now visible
            if (entry.isIntersecting) {
                const img = entry.target;
                // Replace the src with the actual image URL from data-src
                img.src = img.dataset.src;
                // Add fade-in class for a smooth visual transition
                img.classList.remove('lazy-load');
                img.classList.add('fade-in');
                // Stop observing this image since it's already loaded
                observer.unobserve(img);
            }
        });
    }, {
        // Configuration options:
        rootMargin: '200px', // Load images 200px before they enter the viewport
        threshold: 0.1      // Trigger when just 1% of the image becomes visible
    });
    // Start observing the target image
    io.observe(target);
};
// Apply the lazy loading function to each image
lazyImages.forEach(lazyLoad);

/* 
Example usage in HTML:

<img loading="lazy"
    src="assets/images/skeleton.png"
    data-src="assets/images/_logo.png"
    class="lazy-load"
    width="300px"
    alt="Image">
*/