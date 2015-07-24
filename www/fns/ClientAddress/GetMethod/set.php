<?php

namespace ClientAddress\GetMethod;

function set ($name, $content) {

    $content =
        "<?php\n\n"
        ."namespace ClientAddress;\n\n"
        ."function get () {\n$content}\n";

    include_once __DIR__.'/../../file_put_php.php';
    file_put_php(__DIR__.'/../get.php', $content);

    $content =
        "<?php\n\n"
        ."namespace ClientAddress\GetMethod;\n\n"
        ."function get () {\n"
        .'   return '.var_export($name, true).";\n"
        ."}\n";
    file_put_php(__DIR__.'/get.php', $content);

}
