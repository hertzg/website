<?php

namespace ItemList;

function itemParams ($id) {

    include_once __DIR__.'/../request_keyword_tag_offset.php';
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    $params = ['id' => $id];
    if ($keyword !== '') $params['keyword'] = $keyword;
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;

    return $params;

}
