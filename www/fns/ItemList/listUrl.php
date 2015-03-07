<?php

namespace ItemList;

function listUrl ($base = '../') {

    include_once __DIR__.'/../request_keyword_tag_offset.php';
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    $href = $base;
    $params = [];
    if ($keyword !== '') {
        $href .= 'search/';
        $params['keyword'] = $keyword;
    }
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    if ($params) $href .= '?'.http_build_query($params);

    return $href;

}
