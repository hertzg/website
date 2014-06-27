<?php

namespace ItemList;

function itemHiddenInputs ($id) {
    include_once __DIR__.'/pageHiddenInputs.php';
    return pageHiddenInputs(['id' => $id]);
}
