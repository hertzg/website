<?php

namespace SiteTitle;

function set ($siteTitle) {
    $content =
        "<?php\n\n"
        ."namespace SiteTitle;\n\n"
        ."function get () {\n"
        .'    return '.var_export($siteTitle, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
