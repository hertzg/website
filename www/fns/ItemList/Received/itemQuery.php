<?php

namespace ItemList\Received;

function itemQuery ($id) {
    include_once __DIR__.'/pageQuery.php';
    return pageQuery(['id' => $id]);
}
