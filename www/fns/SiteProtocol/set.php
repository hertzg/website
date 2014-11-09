<?php

namespace SiteProtocol;

function set ($siteProtocol) {
    $content =
        "<?php\n\n"
        ."namespace SiteProtocol;\n\n"
        ."function get () {\n"
        .'    return '.var_export($siteProtocol, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
