<?php

function request_note_params () {

    include_once __DIR__.'/../../../fns/Notes/request.php';
    list($text, $tags, $encrypt_in_listings,
        $password_protect) = Notes\request();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$text, $tags, $tag_names, $encrypt_in_listings, $password_protect];

}
