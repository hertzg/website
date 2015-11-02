<?php

function request_note_params () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Notes/request.php";
    list($text, $tags, $encrypt_in_listings) = Notes\request();

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

    return [$text, $tags, $tag_names, $encrypt_in_listings, false, null];

}
