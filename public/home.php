<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="shortcut icon" href="assets/images/favicon.jpg" type="image/jpg">
    <style>
        .container {
            display: flex;
            flex-direction: column;;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            height: 350px;
        }

        img {
           height: 90%;     
        }
        .fade-in {
            opacity: 1;
            transition: opacity 0.3s ease-in;
        }

        .lazy-load {
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
        <div class="card">
            <img loading="lazy"
                src="assets/images/skeleton.png"
                alt="Image"
                data-src="assets/images/_logo.png"
                class="lazy-load">
        </div>
    </div>
    <script src="assets/js/behaviour.js"></script>
</body>

</html>