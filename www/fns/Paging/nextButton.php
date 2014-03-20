<?php

namespace Paging;

function nextButton ($offset, $limit, $label, array $args = array()) {

    include_once __DIR__.'/../Form/button.php';
    include_once __DIR__.'/../Form/hidden.php';
    $html =
        '<form action="./">'
            .\Form\button("Show Next $limit $label")
            .\Form\hidden('offset', $offset + $limit);

    foreach ($args as $key => $value) {
        $html .= Form\hidden('offset', $offset + $limit);
    }

    $html .= '</form>';

    return $html;

}
