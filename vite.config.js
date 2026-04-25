import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [

                //css
                "resources/scss/style.scss",
                "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
                "node_modules/bootstrap-icons/font/bootstrap-icons.css",
                "node_modules/tiny-slider/dist/tiny-slider.css",
                "node_modules/glightbox/dist/css/glightbox.css",
                "node_modules/flatpickr/dist/flatpickr.min.css",
                "node_modules/choices.js/public/assets/styles/choices.min.css",
                "node_modules/nouislider/dist/nouislider.css",
                "node_modules/bs-stepper/dist/css/bs-stepper.min.css",
                "node_modules/@splidejs/splide/dist/css/splide.min.css",
                "node_modules/dropzone/dist/dropzone.css",
                "node_modules/quill/dist/quill.snow.css",
                "node_modules/aos/dist/aos.css",
                "node_modules/overlayscrollbars/styles/overlayscrollbars.min.css",
                "node_modules/apexcharts/dist/apexcharts.css",


                //js
                "resources/js/functions.js"

                ],
            refresh: true,
        }),
    ]
});
