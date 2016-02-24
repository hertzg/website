<?php

namespace ApiKeyAuths;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/../';

    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'api_key_auths', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_api_keys' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'method' => [
            'type' => 'varchar(50)',
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'remote_address' => \IPAddress\column(),
    ]);

}
