<?php

$text_limit = 300;
$is_auth = rand(0, 1);
$user_name = "Алексей";

function crop_text($text, $limit) {
    $text_array = explode(" ", $text);
    $new_string = "";
    $words_counter = 0;

    while (strlen($new_string) < $limit) {
        $new_string = $new_string . " " . $text_array[$words_counter];
        $words_counter++;
        if (strlen($new_string) >= $limit) {
            break;
        };
    };
    return $new_string;
};

require_once("functions.php");
require_once("data.php");

$page_content = include_template("main.php", [
    "posts" => $posts,
    "text_limit" => $text_limit
]);

$layout_content = include_template("layout.php", [
	"content" => $page_content,
	"title" => "readme: популярное"
]);

print($layout_content);
?>
