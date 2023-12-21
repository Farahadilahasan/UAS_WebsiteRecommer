<?php
session_start();

if (isset($_SESSION['login_success_message'])) {
    echo '<div class="success-message">' . $_SESSION['login_success_message'] . '</div>';
    unset($_SESSION['login_success_message']);
}
?>

