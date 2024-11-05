<?php
function abort($code = 404) {
    http_response_code($code);

    $error = "Page not found"; 
    require "views/{$code}.view.php";

    die();
}

