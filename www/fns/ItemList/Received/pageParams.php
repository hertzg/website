<?php

namespace ItemList\Received;

function pageParams ($params = []) {

    include_once __DIR__.'/../../request_strings.php';
    list($all) = request_strings('all');

    if ($all) $params['all'] = '1';

    return $params;

}
