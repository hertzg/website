<?php

namespace ItemList;

function itemQuery ($id) {
    include_once __DIR__.'/pageQuery.php';
    return pageQuery(['id' => $id]);
}
