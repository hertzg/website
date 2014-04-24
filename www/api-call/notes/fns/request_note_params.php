<?php

function request_note_params () {

    include_once __DIR__.'/../../../fns/Notes/requestText.php';
    $text = Notes\requestText();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('Enter text.');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$text, $tags, $tag_names];

}
