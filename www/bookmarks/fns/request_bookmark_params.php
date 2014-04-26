<?php

function request_bookmark_params (&$errors) {

    include_once __DIR__.'/../../fns/Bookmarks/request.php';
    list($url, $title) = Bookmarks\request();

    if ($url === '') $errors[] = 'Enter URL.';

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    return [$url, $title, $tags, $tag_names];

}
