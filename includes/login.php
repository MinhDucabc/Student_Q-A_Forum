<?php
    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();
?>