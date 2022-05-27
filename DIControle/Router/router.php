<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require __DIR__ . './../View/index.php';
        break;
    case '/index.php' :
        require __DIR__ . './../View/index.php';
        break;
    default:
        require __DIR__ . './../View/index.php';
        break;
}
?>