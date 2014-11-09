<?php

namespace SiteBase;

function set ($siteBase) {
    $content =
        "<?php\n\n"
        ."namespace SiteBase;\n\n"
        ."function get () {\n"
        .'    return '.var_export($siteBase, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
