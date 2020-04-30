<?php

$is_auth = rand(0, 1);
$user_name = "Алексей";

$text_limit = 300;

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

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function generate_random_date($index) {
    $deltas = [['minutes' => 59], ['hours' => 23], ['days' => 6], ['weeks' => 4], ['months' => 11], ['years' => 15]];
    $dcnt = count($deltas);

    if ($index < 0) {
        $index = 0;
    }

    if ($index >= $dcnt) {
        $index = $dcnt - 1;
    }

    $delta = $deltas[$index];
    $timeval = rand(1, current($delta));
    $timename = key($delta);

    $ts = strtotime("$timeval $timename ago");
    $dt = date('Y-m-d H:i:s', $ts);

    return $dt;
}

function get_noun_plural_form(int $number, string $one, string $two, string $many): string {
    $number = (int)$number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

function show_passed_time($current, $past) {
    $time_difference = $current - strtotime($past);
    $sec_in_min = 60;
    $sec_in_hour = $sec_in_min * 60;
    $sec_in_day = $sec_in_hour * 24;
    $sec_in_week = $sec_in_day * 7;
    $sec_in_month = $sec_in_day * 30;
    $sec_in_year = $sec_in_day * 365;

    if ($time_difference < $sec_in_min) {
        return $time_difference . get_noun_plural_form($time_difference, " секунда", " секунды", " секунд") . " назад";
    } else if ($time_difference >= $sec_in_min && $time_difference < $sec_in_hour) {
        return floor($time_difference/$sec_in_min) . get_noun_plural_form(floor($time_difference/$sec_in_min), " минута", " минуты", " минут") . " назад";
    } else if ($time_difference >= $sec_in_hour && $time_difference < $sec_in_day) {
        return floor($time_difference/$sec_in_hour) . get_noun_plural_form(floor($time_difference/$sec_in_hour), " час", " часа", " часов") . " назад";
    } else if ($time_difference >= $sec_in_day && $time_difference < $sec_in_week) {
        return floor($time_difference/$sec_in_day) . get_noun_plural_form(floor($time_difference/$sec_in_day), " день", " дня", " дней") . " назад";
    } else if ($time_difference >= $sec_in_week && $time_difference < $sec_in_month) {
        return floor($time_difference/$sec_in_week) . get_noun_plural_form(floor($time_difference/$sec_in_week), " неделя", " недели", " недель") . " назад";
    } else if ($time_difference >= $sec_in_month && $time_difference < $sec_in_year) {
        return floor($time_difference/$sec_in_month) . get_noun_plural_form(floor($time_difference/$sec_in_month), " месяц", " месяца", " месяцев") . " назад";
    } else {
        return floor($time_difference/$sec_in_year) . get_noun_plural_form(floor($time_difference/$sec_in_year), " год", " года", " лет") . " назад";
    }
}
