<?php

namespace ItemList\Received;

function listUrl () {

    include_once __DIR__.'/../../request_strings.php';
    list($all) = request_strings('all');

    $url = './';
    if ($all) $url .= '?all=1';
    return $url;

}
