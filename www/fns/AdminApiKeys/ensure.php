<?php

namespace AdminApiKeys;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKey/column.php";
    include_once "$fnsDir/ApiKeyName/column.php";
    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'admin_api_keys', [
        'access_remote_address' => \IPAddress\column(true),
        'access_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'can_read_invitations' => ['type' => 'tinyint(3) unsigned'],
        'can_read_users' => ['type' => 'tinyint(3) unsigned'],
        'can_write_invitations' => ['type' => 'tinyint(3) unsigned'],
        'can_write_users' => ['type' => 'tinyint(3) unsigned'],
        'expire_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'key' => \ApiKey\column(),
        'name' => \ApiKeyName\column(),
        'revision' => ['type' => 'bigint(20) unsigned'],
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
