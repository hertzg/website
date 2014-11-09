<?php

namespace InfoEmail;

function set ($infoEmail) {
    $content =
        "<?php\n\n"
        ."namespace InfoEmail;\n\n"
        ."function get () {\n"
        .'    return '.var_export($infoEmail, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
