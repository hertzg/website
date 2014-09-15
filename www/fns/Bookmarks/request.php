<?php

namespace Bookmarks;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($url, $title) = request_strings('url', 'title');

    include_once "$fnsDir/str_collapse_spaces.php";
    $url = str_collapse_spaces($url);
    $title = str_collapse_spaces($title);

    return [$url, $title];

}
