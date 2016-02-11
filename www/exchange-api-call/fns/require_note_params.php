<?php

function require_note_params (&$text,
    &$tags, &$tag_names, &$encrypt_in_listings) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Notes/request.php";
    list($text, $tags, $encrypt_in_listings) = Notes\request();

    if ($text === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_TEXT"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
