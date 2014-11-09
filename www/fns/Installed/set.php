<?php

namespace Installed;

function set ($installed) {
    $content =
        "<?php\n\n"
        ."namespace Installed;\n\n"
        ."function get () {\n"
        .'    return '.var_export($installed, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
