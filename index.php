<?php

$page = $_GET['page'];

$style  = file_get_contents("./css/style.css");
$script = file_get_contents("./js/script.js");
$body   = file_get_contents("./pages/$page.html");
$main = str_replace('{body}', $body, str_replace('{script}', $script, str_replace('{style}', $style, file_get_contents("./components/main.html"))));

echo $main;
