<?php

namespace Paging;

function prevButton ($offset, $limit, $total, $label, array $args = []) {

    $html = '<form action="./">';

    if ($offset) {
        include_once __DIR__.'/status.php';
        $html .= status($offset, $limit, $total, strtolower($label));
    }

    include_once __DIR__.'/../Form/button.php';
    $html .= \Form\button("Show Previous $limit $label");

    if ($args) {
        include_once __DIR__.'/../Form/hidden.php';
        foreach ($args as $key => $value) {
            $html .= \Form\hidden($key, $value);
        }
    }

    $prevOffset = max(0, $offset - $limit);
    if ($prevOffset) {
        include_once __DIR__.'/../Form/hidden.php';
        $html .= \Form\hidden('offset', $prevOffset);
    }

    $html .= '</form>';

    return $html;

}
