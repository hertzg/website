<?php

namespace ItemList;

function itemQueryHref ($id) {
    include_once __DIR__.'/itemQuery.php';
    return itemQuery($id);
}
