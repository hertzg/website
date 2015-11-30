<?php

namespace Calculations;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($url, $title, $tags) = request_strings('url', 'title', 'tags');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $url = str_collapse_spaces($url);
    $url = mb_substr($url, 0, $maxLengths['url'], 'UTF-8');

    $title = str_collapse_spaces($title);
    $title = mb_substr($title, 0, $maxLengths['title'], 'UTF-8');

    $tags = str_collapse_spaces($tags);
    $tags = mb_substr($tags, 0, $maxLengths['tags'], 'UTF-8');

    return [$url, $title, $tags];

}
