<?php

namespace NumReverseProxies;

function set ($number) {
    $content =
        "<?php\n\n"
        ."namespace NumReverseProxies;\n\n"
        ."function get () {\n"
        .'    return '.var_export($number, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
