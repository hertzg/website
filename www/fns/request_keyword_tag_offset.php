<?php

function request_keyword_tag_offset () {

    include_once __DIR__.'/request_strings.php';
    list($keyword, $tag, $offset) = request_strings(
        'keyword', 'tag', 'offset');

    include_once __DIR__.'/str_collapse_spaces.php';
    $keyword = str_collapse_spaces($keyword);
    $tag = str_collapse_spaces($tag);
    $offset = abs((int)$offset);

    return [$keyword, $tag, $offset];

}
