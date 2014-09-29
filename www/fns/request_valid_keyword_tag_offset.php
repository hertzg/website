<?php

function request_valid_keyword_tag_offset () {

    include_once __DIR__.'/request_keyword_tag_offset.php';
    $values = request_keyword_tag_offset();

    $keyword = $values[0];

    if ($keyword === '') {

        $url = '../';

        $tag = $values[1];
        if ($tag !== '') $url .= '?tag='.rawurlencode($tag);

        include_once __DIR__.'/redirect.php';
        redirect($url);

    }

    include_once __DIR__.'/Paging/limit.php';
    $limit = Paging\limit();

    if ($values[2] % $limit) {
        include_once __DIR__.'/redirect.php';
        redirect('./?keyword='.rawurlencode($keyword));
    }

    return $values;

}
