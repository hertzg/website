<?php

namespace ItemList;

function escapedItemQuery ($id) {
    include_once __DIR__.'/itemQuery.php';
    return htmlspecialchars(itemQuery($id));
}
