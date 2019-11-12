<?php

$page = $_GET['page'];

$style  = file_get_contents("./css/style.css");
$script = file_get_contents("./js/script.js");
$header = str_replace('{title}', '<b>'.strtoupper($page).'</b>', str_replace('{script}', $script, str_replace('{style}', $style, file_get_contents("./components/header.html"))));
$footer = file_get_contents("./components/footer.html");
$body   = file_get_contents("./pages/$page.html");

echo $header.$body.$footer;
