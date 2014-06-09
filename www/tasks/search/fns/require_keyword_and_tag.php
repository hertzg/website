<?php

function require_keyword_and_tag () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($keyword, $tag, $offset) = request_strings('keyword', 'tag', 'offset');

    if ($keyword === '') {
        $url = '../';
        if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
        include_once "$fnsDir/redirect.php";
        redirect($url);
    }

    $offset = abs((int)$offset);

    return [$keyword, $tag, $offset];

}
