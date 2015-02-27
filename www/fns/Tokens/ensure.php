<?php

namespace Tokens;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
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
            'type' => "binary($maxLengths[token_text])",
        ],
        'username' => [
            'type' => "varchar($maxLengths[username])",
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
