<?php

namespace Admin;

function set ($username, $hash, $salt) {

    $varExportHex = function ($s) {
        return '"'.preg_replace_callback('/../', function ($s) {
            return "\\x$s[0]";
        }, bin2hex($s)).'"';
    };

    $content =
        "<?php\n\n"
        ."namespace Admin;\n\n"
        ."function get (&\$username, &\$hash, &\$salt) {\n"
        .'    $username = '.var_export($username, true).";\n"
        .'    $hash = '.$varExportHex($hash).";\n"
        .'    $salt = '.$varExportHex($salt).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);

}
