<?php

require_once("functions.php");
require_once("data.php");

$page_content = include_template("main.php", [
    "posts" => $posts,
    "text_limit" => $text_limit
]);

$layout_content = include_template("layout.php", [
    "is_auth" => $is_auth,
	"content" => $page_content,
	"title" => "readme: популярное"
]);

print($layout_content);
