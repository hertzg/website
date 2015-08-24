<?php

namespace Admin;

function set ($username, $hash, $salt, $sha512_hash, $sha512_key) {

    $varExportHex = function ($s) {
        return '"'.preg_replace_callback('/../', function ($s) {
            return "\\x$s[0]";
        }, bin2hex($s)).'"';
    };

    $content =
        "<?php\n\n"
        ."namespace Admin;\n\n"
        ."function get (&\$username, &\$hash, &\$salt, &\$sha512_hash, &\$sha512_key) {\n"
        .'    $username = '.var_export($username, true).";\n"
        .'    $hash = '.$varExportHex($hash).";\n"
        ."    \$salt =\n"
        .'        '.$varExportHex(substr($salt, 0, 16))."\n"
        .'        .'.$varExportHex(substr($salt, 16)).";\n"
        ."    \$sha512_hash =\n"
        .'        '.$varExportHex(substr($sha512_hash, 0, 16))."\n"
        .'        .'.$varExportHex(substr($sha512_hash, 16, 16))."\n"
        .'        .'.$varExportHex(substr($sha512_hash, 32, 16))."\n"
        .'        .'.$varExportHex(substr($sha512_hash, 48)).";\n"
        ."    \$sha512_key =\n"
        .'        '.$varExportHex(substr($sha512_key, 0, 16))."\n"
        .'        .'.$varExportHex(substr($sha512_key, 16, 16))."\n"
        .'        .'.$varExportHex(substr($sha512_key, 32, 16))."\n"
        .'        .'.$varExportHex(substr($sha512_key, 48)).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);

}
