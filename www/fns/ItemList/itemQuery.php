<?php

namespace ItemList;

function itemQuery ($id) {
    include_once __DIR__.'/itemParams.php';
    $params = itemParams($id);
    if ($params) return '?'.http_build_query($params);
}
