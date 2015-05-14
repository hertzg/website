<?php

namespace ItemList;

function listHref ($base = '../', $params = []) {
    include_once __DIR__.'/listUrl.php';
    return htmlspecialchars(listUrl($base, $params));
}
