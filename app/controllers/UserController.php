<?php


if ($uri === '/signin'){
    require __DIR__ . '/../views/auth/signin.php';
} elseif ($uri === '/signup') {
    require __DIR__ . '/../views/auth/signup.php';
}
?>