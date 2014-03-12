<?php

function require_keyword_and_tag () {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($keyword, $tag) = request_strings('keyword', 'tag');

    if ($keyword === '') {
        $url = '../';
        if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect($url);
    }

    return array($keyword, $tag);

}
