<?php

namespace Wallets;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'wallets', [
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
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
