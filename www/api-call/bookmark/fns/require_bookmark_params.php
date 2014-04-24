<?php

function require_bookmark_params () {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($url, $title) = request_strings('url', 'title');

    include_once __DIR__.'/../../../fns/str_collapse_spaces.php';
    $url = str_collapse_spaces($url);
    $title = str_collapse_spaces($title);

    if ($url === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('Enter URL.');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$url, $title, $tags, $tag_names];

}
