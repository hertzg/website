<?php

function check_offset_overflow ($offset, $limit, $total, $params) {

    if (!$offset || $offset < $total) return;

    $remainder = $total % $limit;
    if ($remainder) $offset = $total - $remainder;
    elseif ($total) $offset = $total - $limit;
    else $offset = 0;

    if ($offset) $params['offset'] = $offset;
    else unset($params['offset']);

    if ($params) $url = '?'.http_build_query($params);
    else $url = './';

    include_once __DIR__.'/redirect.php';
    redirect($url);

}
