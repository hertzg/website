<?php

function request_valid_keyword_tag_offset () {

    include_once __DIR__.'/request_keyword_tag_offset.php';
    $values = request_keyword_tag_offset();

    if ($values[0] === '') {
        $url = '../';
        if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
        include_once __DIR__.'/redirect.php';
        redirect($url);
    }

    return $values;

}
