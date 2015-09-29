<?php

function format_author ($time, $api_key_name) {
    include_once __DIR__.'/../../fns/export_date_ago.php';
    $html = export_date_ago($time);
    if ($api_key_name !== null) {
        $escapedName = htmlspecialchars($api_key_name);
        $html .= " using <b class=\"author\">$escapedName</b> admin API key";
    }
    return $html;
}
