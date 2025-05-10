<?php
if (!function_exists('secure_session_start')) {
    function secure_session_start(): void
    {
        // Ensure session cookies are not accessible via JavaScript.
        ini_set('session.cookie_httponly', 1);

        // Ensure session cookies are only sent over HTTPS.
        $is_https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
        ini_set('session.cookie_secure', $is_https ? 1 : 0);

        // Prevent session fixation attacks by only using cookies for session IDs.
        ini_set('session.use_only_cookies', 1);

        ini_set('session.cookie_samesite', 'Lax');
        ini_set('session.gc_maxlifetime', 1800); // 30 minutes
        ini_set('session.cookie_lifetime', 0); // Session cookie expires when browser closes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Optional: Regenerate session ID to prevent session fixation after session start
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
        }
    }
}
// Start the session upon file load
secure_session_start();