<?php

namespace ClientAddress\GetMethod;

function setBehindProxy () {
    $content =
        "    \$key = 'HTTP_X_FORWARDED_FOR';\n"
        ."    if (!array_key_exists(\$key, \$_SERVER)) return false;\n"
        ."    \$addresses = explode(', ', \$_SERVER[\$key]);\n"
        ."    return array_pop(\$addresses);\n";
    include_once __DIR__.'/set.php';
    set('behind_proxy', $content);
}
