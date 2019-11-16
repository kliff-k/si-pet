<?php

session_start();

$page = $_GET['page'];

$body   = file_get_contents("../pages/$page.html");
$main   = file_get_contents("../pages/main.html");
$main   = str_replace("{active-$page}", 'active', $main);
$main   = str_replace("{body}", $body, $main);

echo $main;
