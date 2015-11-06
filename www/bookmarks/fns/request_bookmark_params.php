<?php

function request_bookmark_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Bookmarks/request.php";
    list($url, $title, $tags) = Bookmarks\request();

    if ($url === '') {
        $errors[] = 'Enter URL.';
        $focus = 'url';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$url, $title, $tags, $tag_names];

}
