<?php

namespace Paging;

function requestOffset ($url = './') {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($offset) = request_strings('offset');

    $offset = abs((int)$offset);

    include_once __DIR__.'/limit.php';
    $limit = limit();

    if ($offset % $limit) {
        include_once "$fnsDir/redirect.php";
        redirect($url);
    }

    return $offset;

}
