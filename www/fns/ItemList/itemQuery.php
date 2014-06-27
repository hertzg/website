<?php

namespace ItemList;

function itemQuery ($id) {
    include_once __DIR__.'/itemParams.php';
    $itemParams = itemParams($id);
    if ($itemParams) return '?'.http_build_query($itemParams);
}
