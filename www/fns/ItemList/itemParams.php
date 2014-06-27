<?php

namespace ItemList;

function itemParams ($id) {
    include_once __DIR__.'/pageParams.php';
    return pageParams(['id' => $id]);
}
