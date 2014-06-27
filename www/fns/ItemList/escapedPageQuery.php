<?php

namespace ItemList;

function escapedPageQuery (array $params = []) {
    include_once __DIR__.'/pageQuery.php';
    return htmlspecialchars(pageQuery($params));
}
