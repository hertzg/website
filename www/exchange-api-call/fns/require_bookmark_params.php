<?php

function require_bookmark_params (&$url, &$title, &$tags, &$tag_names) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Bookmarks/request.php";
    list($url, $title, $tags) = Bookmarks\request();

    if ($url === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_URL"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
