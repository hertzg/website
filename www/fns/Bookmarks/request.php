<?php

namespace Bookmarks;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($url, $title, $tags) = request_strings('url', 'title', 'tags');

    include_once "$fnsDir/str_collapse_spaces.php";
    $url = str_collapse_spaces($url);
    $title = str_collapse_spaces($title);
    $tags = str_collapse_spaces($tags);

    return [$url, $title, $tags];

}
