<?php

namespace ItemList;

function itemHiddenInputs ($id) {

    include_once __DIR__.'/../request_keyword_tag_offset.php';
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    include_once __DIR__.'/../Form/hidden.php';
    $html = \Form\hidden('id', $id);
    if ($keyword !== '') $html .= \Form\hidden('keyword', $keyword);
    if ($tag !== '') $html .= \Form\hidden('tag', $tag);
    if ($offset) $html .= \Form\hidden('offset', $offset);
    return $html;

}
