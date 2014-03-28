<?php

namespace Paging;

function nextButton ($offset, $limit, $label, array $args = []) {

    include_once __DIR__.'/../Form/button.php';
    $html =
        '<form action="./">'
            .\Form\button("Show More $label");

    include_once __DIR__.'/../Form/hidden.php';
    foreach ($args as $key => $value) {
        $html .= \Form\hidden($key, $value);
    }

    $html .=
            \Form\hidden('offset', $offset + $limit)
        .'</form>';

    return $html;

}
