<?php

function format_author ($time, $api_key_name) {
    include_once __DIR__.'/date_ago.php';
    $html = date_ago($time);
    if ($api_key_name !== null) {
        $html .= ' with "<b>'.htmlspecialchars($api_key_name).'</b>"';
    }
    return $html;
}
