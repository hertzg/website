<?php

function require_bookmark_params () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Bookmarks/request.php";
    list($url, $title, $tags) = Bookmarks\request();

    if ($url === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_URL"');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$url, $title, $tags, $tag_names];

}
