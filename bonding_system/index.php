<?php
require_once __DIR__ . '/includes/auth.php';

if (is_logged_in()) {
    header('Location: views/dashboard.php', true, 302);
} else {
    header('Location: views/login.php', true, 302);
}
exit;
?>
