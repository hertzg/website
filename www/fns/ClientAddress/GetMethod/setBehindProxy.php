<?php

namespace ClientAddress\GetMethod;

function setBehindProxy () {
    $content =
        "    \$addresses = explode(', ', \$_SERVER['HTTP_X_FORWARDED_FOR']);\n"
        ."    return array_pop(\$addresses);\n";
    include_once __DIR__.'/set.php';
    set('behind_proxy', $content);
}
