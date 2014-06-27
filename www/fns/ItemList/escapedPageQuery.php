<?php

namespace ItemList;

function escapedPageQuery (array $params = []) {
    include_once __DIR__.'/pageParams.php';
    $pageParams = pageParams($params);
    if ($pageParams) return '?'.htmlspecialchars(http_build_query($pageParams));
}
