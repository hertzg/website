<?php

function request_valid_keyword_tag_offset (&$keyword,
    &$tag, &$offset, &$includes, &$excludes, $params = []) {

    include_once __DIR__.'/request_keyword_tag_offset.php';
    $values = request_keyword_tag_offset();

    list($keyword, $tag, $offset) = $values;

    if ($keyword === '') {

        $url = '../';
        if ($tag !== '') $params['tag'] = $tag;
        if ($offset !== 0) $params['offset'] = $offset;
        if ($params) $url .= '?'.http_build_query($params);

        include_once __DIR__.'/redirect.php';
        redirect($url);

    }

    include_once __DIR__.'/Paging/limit.php';
    $limit = Paging\limit();

    if ($offset % $limit) {

        $params['keyword'] = $keyword;
        if ($tag !== '') $params['tag'] = $tag;

        include_once __DIR__.'/redirect.php';
        redirect('./?'.http_build_query($params));

    }

    include_once __DIR__.'/parse_keyword.php';
    parse_keyword($keyword, $includes, $excludes);

}
