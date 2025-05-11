<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'SiteName'); ?></title>
    <!-- link favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.jpg" type="image/jpg">
    <!-- include Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- include bootstrap with popper -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <!-- include lottiefiles -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <!-- include jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <?php
    if (isset($importCss) && is_array($importCss) && !empty($importCss)) {
        foreach ($importCss as $css) {
            echo '<link rel="stylesheet" href="' . $css . '">';
        }
    }
    ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/public/home"><?php echo htmlspecialchars($siteName ?? 'SiteName'); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/public/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/contact">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex ms-lg-3 me-lg-3 my-2 my-lg-0" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <div class="d-flex">
                    <a href="/login" class="btn btn-outline-primary me-2">Login</a>
                    <a href="/signup" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>