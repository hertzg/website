<?php

namespace ItemList;

function itemHiddenInputs ($id) {

    include_once __DIR__.'/itemParams.php';
    $params = itemParams($id);

    $html = '';
    if ($params) {
        include_once __DIR__.'/../Form/hidden.php';
        foreach ($params as $key => $value) {
            $html .= \Form\hidden($key, $value);
        }
    }
    return $html;

}
