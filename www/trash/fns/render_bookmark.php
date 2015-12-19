<?php

function render_bookmark ($bookmark, &$title, &$icon) {

    $title = $bookmark->title;
    if ($title === '') $title = $bookmark->url;
    $title = htmlspecialchars($title);

    $icon = 'bookmark';

}
