<?php

function request_contact_params () {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($full_name) = request_strings('full_name');

    if ($full_name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_FULL_NAME');
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    list($tags, $tag_names) = request_tags();

    return [$full_name, $tags, $tag_names];

}
