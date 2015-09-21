<?php

namespace Users\OrderBy;

function set ($order_by) {
    $content =
        "<?php\n\n"
        ."namespace Users\OrderBy;\n\n"
        ."function get () {\n"
        .'    return '.var_export($order_by, true).";\n"
        ."}\n";
    include_once __DIR__.'/../../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
