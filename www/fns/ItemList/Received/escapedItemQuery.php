<?php

namespace ItemList\Received;

function escapedItemQuery ($id) {
    include_once __DIR__.'/escapedPageQuery.php';
    return escapedPageQuery(['id' => $id]);
}
