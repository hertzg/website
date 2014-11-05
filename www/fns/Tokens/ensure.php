<?php

namespace Tokens;


function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/maxLength.php";
    return \Table\ensure($mysqli, 'tokens', [
        'access_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'token_text' => [
            'type' => 'binary(16)',
        ],
        'username' => [
            'type' => 'varchar('.\Username\maxLength().')',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'user_agent' => [
            'type' => 'varchar(1024)',
            'nullable' => true,
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
    ]);

}
