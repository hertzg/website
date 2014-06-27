<?php

namespace ItemList;

function pageHiddenInputs (array $params = []) {

    include_once __DIR__.'/pageParams.php';
    $pageParams = pageParams($params);

    $html = '';
    if ($pageParams) {
        include_once __DIR__.'/../Form/hidden.php';
        foreach ($pageParams as $key => $value) {
            $html .= \Form\hidden($key, $value);
        }
    }
    return $html;

}
