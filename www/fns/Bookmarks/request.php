<?php

namespace Bookmarks;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($url, $title) = request_strings('url', 'title');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $url = str_collapse_spaces($url);
    $title = str_collapse_spaces($title);

    return [$url, $title];

}
