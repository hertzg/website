<?php

function request_bookmark_params (&$errors) {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($title, $url) = request_strings('title', 'url');

    include_once __DIR__.'/../../fns/str_collapse_spaces.php';
    $title = str_collapse_spaces($title);
    $url = str_collapse_spaces($url);

    if ($url === '') $errors[] = 'Enter URL.';

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    return [$url, $title, $tags, $tag_names];

}
