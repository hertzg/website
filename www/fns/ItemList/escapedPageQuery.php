<?php

namespace ItemList;

function escapedPageQuery ($params = []) {
    include_once __DIR__.'/pageQuery.php';
    return htmlspecialchars(pageQuery($params));
}
