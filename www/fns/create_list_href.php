<?php

function create_list_href () {

    include_once __DIR__.'/request_keyword_tag_offset.php';
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    $base = '../';
    $params = [];
    if ($keyword !== '') {
        $base .= 'search/';
        $params['keyword'] = $keyword;
    }
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    $queryString = htmlspecialchars(http_build_query($params));
    return "$base?$queryString";

}
