<?php

function request_note_params (&$errors) {

    include_once __DIR__.'/../../fns/Notes/requestText.php';
    $text = Notes\requestText();

    if ($text === '') $errors[] = 'Enter text.';

    include_once __dir__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    return [$text, $tags, $tag_names];

}
