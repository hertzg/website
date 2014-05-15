<?php

namespace ItemList;

function itemHiddenInputs ($id) {

    include_once __DIR__.'/itemParams.php';
    $params = itemParams($id);

    $html = '';
    foreach ($params as $key => $value) {
        $html .= \Form\hidden($key, $value);
    }
    return $html;

}
