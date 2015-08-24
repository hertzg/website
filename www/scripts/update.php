#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$varExportHex = function ($s) {
    return '"'.preg_replace_callback('/../', function ($s) {
        return "\\x$s[0]";
    }, bin2hex($s)).'"';
};

include_once '../fns/Admin/get.php';
Admin\get($username, $hash, $salt);

$content =
    "<?php\n\n"
    ."namespace Admin;\n\n"
    ."function get (&\$username, &\$hash, &\$salt, &\$sha512_hash, &\$sha512_key) {\n"
    .'    $username = '.var_export($username, true).";\n"
    .'    $hash = '.$varExportHex($hash).";\n"
    ."    \$salt =\n"
    .'        '.$varExportHex(substr($salt, 0, 16))."\n"
    .'        .'.$varExportHex(substr($salt, 16)).";\n"
    ."    \$sha512_hash = null;\n"
    ."    \$sha512_key = null;\n"
    ."}\n";

include_once '../fns/file_put_php.php';
return file_put_php('../Admin/get.php', $content);

echo "Done\n";
