<?php

namespace Channels;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'channels', [
        'channel_name' => [
            'type' => "varchar($maxLengths[channel_name])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_general_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => [
            'type' => "varchar($maxLengths[insert_api_key_name])",
            'nullable' => true,
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'lowercase_name' => [
            'type' => "varchar($maxLengths[lowercase_name])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_general_ci',
        ],
        'num_notifications' => ['type' => 'bigint(20) unsigned'],
        'num_users' => ['type' => 'bigint(20) unsigned'],
        'public' => ['type' => 'tinyint(3) unsigned'],
        'receive_notifications' => ['type' => 'tinyint(3) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'update_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'update_api_key_name' => [
            'type' => "varchar($maxLengths[update_api_key_name])",
            'nullable' => true,
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'update_time' => ['type' => 'bigint(20) unsigned'],
        'username' => \Username\column(),
    ]);

}
