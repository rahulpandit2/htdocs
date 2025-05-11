<?php
$pageTitle = 'Page Not Found';
$siteName = 'Localhost';
$importCss = [
    'assets/css/style.css',
    'assets/css/behaviour.css'
];
require_once(__DIR__ . '/../partials/header.php');
?>
<!-- html -->
<div class="container text-center d-flex flex-column justify-content-center align-items-center">
    <div class="lottie-container">
        <dotlottie-player
            src="https://lottie.host/137cdcb4-b89a-4dc3-8951-4206f6080631/9DW5V6hLz4.lottie"
            background="transparent"
            speed="1"
            style="width: 300px; height: 300px"
            loop
            autoplay></dotlottie-player>
    </div>
    <h1 class="mt-4">Oops! Page Not Found</h1>
    <p class="lead">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
    <a href="/public/home" class="btn btn-primary mt-3">Go to Homepage</a>
</div>
<script src="assets/js/behaviour.js"></script>
</body>

</html>