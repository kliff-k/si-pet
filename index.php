<?php

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

$page = $_GET['page'];

$style  = file_get_contents("./css/style.css");
$script = file_get_contents("./js/script.js");
$body   = file_get_contents("./pages/$page.php");
$main   = file_get_contents("./pages/main.php");
$main   = str_replace("{style}", $style, $main);
$main   = str_replace("{script}", $script, $main);
$main   = str_replace("{active-$page}", 'active', $main);
$main   = str_replace("{body}", $body, $main);

echo $main;
