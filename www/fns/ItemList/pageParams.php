<?php

namespace ItemList;

function pageParams (array $params = []) {

    include_once __DIR__.'/../request_keyword_tag_offset.php';
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    if ($keyword !== '') $params['keyword'] = $keyword;
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    return $params;

}
