<?php

function request_contact_params () {

    include_once __DIR__.'/../../../fns/Contacts/requestText.php';
    $text = Contacts\requestText();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$text, $tags, $tag_names];

}
