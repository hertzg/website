<?php

namespace AdminConnections;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once __DIR__.'/maxLengths.php';
    include_once "$fnsDir/ApiKey/column.php";
    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'admin_connections', [
        'access_remote_address' => \IPAddress\column(true),
        'access_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'address' => [
            'type' => 'varchar('.maxLengths()['address'].')',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'expire_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'our_exchange_api_key' => \ApiKey\column(),
        'revision' => ['type' => 'bigint(20) unsigned'],
        'their_exchange_api_key' => \ApiKey\column(true),
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
