<?php

namespace Tokens;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Username/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'tokens', [
        'access_time' => ['type' => 'bigint(20) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'token_text' => ['type' => "binary($maxLengths[token_text])"],
        'username' => \Username\column(),
        'user_agent' => [
            'type' => 'varchar(1024)',
            'nullable' => true,
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);

}
