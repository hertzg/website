<?php

namespace Tables;

function ensureAll ($mysqli) {
    $output = '';
    include_once __DIR__.'/index.php';
    foreach (index() as $table) {
        include_once __DIR__."/../$table/ensure.php";
        $output .= call_user_func("$table\\ensure", $mysqli);
    }
    return $output;
}
