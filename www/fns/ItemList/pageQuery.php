<?php

namespace ItemList;

function pageQuery (array $params = []) {
    include_once __DIR__.'/pageParams.php';
    $pageParams = pageParams($params);
    if ($pageParams) return '?'.http_build_query($pageParams);
}
