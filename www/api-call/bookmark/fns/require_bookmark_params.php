<?php

function require_bookmark_params () {

    include_once __DIR__.'/../../../fns/Bookmarks/request.php';
    list($url, $title) = Bookmarks\request();

    if ($url === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_URL');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$url, $title, $tags, $tag_names];

}
