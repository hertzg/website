<?php

namespace SignUpEnabled;

function set ($enabled) {
    $content =
        "<?php\n\n"
        ."namespace SignUpEnabled;\n\n"
        ."function get () {\n"
        .'    return '.var_export($enabled, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
