<?php

namespace MysqlConfig;

function set ($host, $username, $password, $db) {
    $content =
        "<?php\n\n"
        ."namespace MysqlConfig;\n\n"
        ."function get (&\$host, &\$username, &\$password, &\$db) {\n"
        .'    $host = '.var_export($host, true).";\n"
        .'    $username = '.var_export($username, true).";\n"
        .'    $password = '.var_export($password, true).";\n"
        .'    $db = '.var_export($db, true).";\n"
        ."}\n";
    include_once __DIR__.'/../file_put_php.php';
    return file_put_php(__DIR__.'/get.php', $content);
}
