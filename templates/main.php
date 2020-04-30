<?

$current_date = strtotime(date('Y-m-d H:i:s'));

function generate_random_date($index) {
    $deltas = [['seconds' => 59], ['minutes' => 59], ['hours' => 23], ['days' => 6], ['weeks' => 4], ['months' => 11], ['years' => 15]];
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
    $diff_time = $current - strtotime($past);
    $sec_in_min = 60;
    $sec_in_hour = $sec_in_min * 60;
    $sec_in_day = $sec_in_hour * 24;
    $sec_in_week = $sec_in_day * 7;
    $sec_in_month = $sec_in_day * 30;
    $sec_in_year = $sec_in_day * 365;

    if ($diff_time < $sec_in_min) {
        return $diff_time . get_noun_plural_form($diff_time, " секунда", " секунды", " секунд") . " назад";
    } else if ($diff_time >= $sec_in_min && $diff_time < $sec_in_hour) {
        return round($diff_time/$sec_in_min) . get_noun_plural_form(round($diff_time/$sec_in_min), " минута", " минуты", " минут") . " назад";
    } else if ($diff_time >= $sec_in_hour && $diff_time < $sec_in_day) {
        return round($diff_time/$sec_in_hour) . get_noun_plural_form(round($diff_time/$sec_in_hour), " час", " часа", " часов") . " назад";
    } else if ($diff_time >= $sec_in_day && $diff_time < $sec_in_week) {
        return round($diff_time/$sec_in_day) . get_noun_plural_form(round($diff_time/$sec_in_day), " день", " дня", " дней") . " назад";
    } else if ($diff_time >= $sec_in_week && $diff_time < $sec_in_month) {
        return round($diff_time/$sec_in_week) . get_noun_plural_form(round($diff_time/$sec_in_week), " неделя", " недели", " недель") . " назад";
    } else if ($diff_time >= $sec_in_month && $diff_time < $sec_in_year) {
        return round($diff_time/$sec_in_month) . get_noun_plural_form(round($diff_time/$sec_in_month), " месяц", " месяца", " месяцев") . " назад";
    } else {
        return round($diff_time/$sec_in_year) . get_noun_plural_form(round($diff_time/$sec_in_year), " год", " года", " лет") . " назад";
    }
}

?>


<div class="container">
    <h1 class="page__title page__title--popular">Популярное</h1>
</div>
<div class="popular container">
    <div class="popular__filters-wrapper">
        <div class="popular__sorting sorting">
            <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
            <ul class="popular__sorting-list sorting__list">
                <li class="sorting__item sorting__item--popular">
                    <a class="sorting__link sorting__link--active" href="#">
                        <span>Популярность</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Лайки</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Дата</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="popular__filters filters">
            <b class="popular__filters-caption filters__caption">Тип контента:</b>
            <ul class="popular__filters-list filters__list">
                <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                    <a class="filters__button filters__button--ellipse filters__button--all filters__button--active" href="#">
                        <span>Все</span>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--photo button" href="#">
                        <span class="visually-hidden">Фото</span>
                        <svg class="filters__icon" width="22" height="18">
                            <use xlink:href="#icon-filter-photo"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--video button" href="#">
                        <span class="visually-hidden">Видео</span>
                        <svg class="filters__icon" width="24" height="16">
                            <use xlink:href="#icon-filter-video"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--text button" href="#">
                        <span class="visually-hidden">Текст</span>
                        <svg class="filters__icon" width="20" height="21">
                            <use xlink:href="#icon-filter-text"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--quote button" href="#">
                        <span class="visually-hidden">Цитата</span>
                        <svg class="filters__icon" width="21" height="20">
                            <use xlink:href="#icon-filter-quote"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--link button" href="#">
                        <span class="visually-hidden">Ссылка</span>
                        <svg class="filters__icon" width="21" height="18">
                            <use xlink:href="#icon-filter-link"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="popular__posts">
    <? $i = 0; ?>

        <?php foreach ($posts as $post): ?>
        <? $random_date = generate_random_date($i) ?>
        <? $passed_time = show_passed_time($current_date, $random_date); ?>
        <article class="popular__post post <?=$post["type"];?>">
            <header class="post__header">
                <h2><?=htmlspecialchars($post["title"]);?></h2>
            </header>
            <div class="post__main">
                <?php if ($post["type"] === "post-quote"): ?>
                    <blockquote>
                        <p><?= htmlspecialchars($post["content"]); ?></p>
                        <cite>Неизвестный Автор</cite>
                    </blockquote>
                <?php elseif ($post["type"] === "post-text"): ?>
                    <?php if (strlen($post["content"]) <= $text_limit): ?>
                        <p><?= htmlspecialchars($post["content"]); ?></p>
                    <?php else: ?>
                        <p><?= htmlspecialchars(crop_text($post["content"], $text_limit)) . "..."; ?></p>
                        <a class="post-text__more-link" href="#">Читать далее</a>
                    <?php endif; ?>
                <?php elseif ($post["type"] === "post-photo"): ?>
                    <div class="post-photo__image-wrapper">
                        <img src="img/<?=$post["content"];?>" alt="Фото от пользователя" width="360" height="240">
                    </div>
                <?php elseif ($post["type"] === "post-video"): ?>
                    <div class="post-video__block">
                        <div class="post-video__preview">
                            <?=embed_youtube_cover($post["content"]); ?>
                                <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                        </div>
                        <a href="post-details.html" class="post-video__play-big button">
                            <svg class="post-video__play-big-icon" width="14" height="14">
                                <use xlink:href="#icon-video-play-big"></use>
                            </svg>
                            <span class="visually-hidden">Запустить проигрыватель</span>
                        </a>
                    </div>
                <?php elseif ($post["type"] === "post-link"): ?>
                    <div class="post-link__wrapper">
                        <a class="post-link__external" href="http://<?=$post["content"];?>" title="Перейти по ссылке">
                            <div class="post-link__info-wrapper">
                                <div class="post-link__icon-wrapper">
                                    <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                                </div>
                                <div class="post-link__info">
                                    <h3><?=$post["title"];?></h3>
                                </div>
                            </div>
                            <span><?=$post["content"];?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <footer class="post__footer">
                <div class="post__author">
                    <a class="post__author-link" href="#" title="<?=$random_date?>">
                        <div class="post__avatar-wrapper">
                            <img class="post__author-avatar" src="img/<?=$post["avatar"];?>" alt="Аватар пользователя">
                        </div>
                        <div class="post__info">
                            <b class="post__author-name"><?=$post["user"];?></b>
                            <time class="post__time" datetime="<?=$random_date?>"><?=$passed_time?></time>
                        </div>
                    </a>
                </div>
                <div class="post__indicators">
                    <div class="post__buttons">
                        <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                            <svg class="post__indicator-icon" width="20" height="17">
                                <use xlink:href="#icon-heart"></use>
                            </svg>
                            <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                <use xlink:href="#icon-heart-active"></use>
                            </svg>
                            <span>0</span>
                            <span class="visually-hidden">количество лайков</span>
                        </a>
                        <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                            <svg class="post__indicator-icon" width="19" height="17">
                                <use xlink:href="#icon-comment"></use>
                            </svg>
                            <span>0</span>
                            <span class="visually-hidden">количество комментариев</span>
                        </a>
                    </div>
                </div>
            </footer>
        </article>
        <? $i++ ?>
        <?php endforeach; ?>
    </div>
</div>
