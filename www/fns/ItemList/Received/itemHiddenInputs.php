<?php

namespace ItemList\Received;

function itemHiddenInputs ($id) {
    include_once __DIR__.'/pageHiddenInputs.php';
    return pageHiddenInputs(['id' => $id]);
}
