<?php

function check_offset_overflow ($offset, $limit, $total, $params = []) {

    if ($offset === 0 || $offset < $total) return;

    $remainder = $total % $limit;
    if ($remainder > 0) $params['offset'] = $total - $remainder;
    elseif ($total > 0) $params['offset'] = $total - $limit;
    else unset($params['offset']);

    include_once __DIR__.'/redirect.php';
    redirect($params ? '?'.http_build_query($params) : './');

}
