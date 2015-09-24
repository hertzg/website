<?php

namespace ApiKeys;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKey/column.php";
    include_once "$fnsDir/ApiKeyName/column.php";
    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'api_keys', [
        'access_remote_address' => \IPAddress\column(true),
        'access_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'can_read_bar_charts' => ['type' => 'tinyint(3) unsigned'],
        'can_read_bookmarks' => ['type' => 'tinyint(3) unsigned'],
        'can_read_channels' => ['type' => 'tinyint(3) unsigned'],
        'can_read_contacts' => ['type' => 'tinyint(3) unsigned'],
        'can_read_events' => ['type' => 'tinyint(3) unsigned'],
        'can_read_files' => ['type' => 'tinyint(3) unsigned'],
        'can_read_notes' => ['type' => 'tinyint(3) unsigned'],
        'can_read_notifications' => ['type' => 'tinyint(3) unsigned'],
        'can_read_places' => ['type' => 'tinyint(3) unsigned'],
        'can_read_schedules' => ['type' => 'tinyint(3) unsigned'],
        'can_read_tasks' => ['type' => 'tinyint(3) unsigned'],
        'can_read_wallets' => ['type' => 'tinyint(3) unsigned'],
        'can_write_bar_charts' => ['type' => 'tinyint(3) unsigned'],
        'can_write_bookmarks' => ['type' => 'tinyint(3) unsigned'],
        'can_write_channels' => ['type' => 'tinyint(3) unsigned'],
        'can_write_contacts' => ['type' => 'tinyint(3) unsigned'],
        'can_write_events' => ['type' => 'tinyint(3) unsigned'],
        'can_write_files' => ['type' => 'tinyint(3) unsigned'],
        'can_write_notes' => ['type' => 'tinyint(3) unsigned'],
        'can_write_notifications' => ['type' => 'tinyint(3) unsigned'],
        'can_write_places' => ['type' => 'tinyint(3) unsigned'],
        'can_write_schedules' => ['type' => 'tinyint(3) unsigned'],
        'can_write_tasks' => ['type' => 'tinyint(3) unsigned'],
        'can_write_wallets' => ['type' => 'tinyint(3) unsigned'],
        'expire_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'key' => \ApiKey\column(),
        'name' => \ApiKeyName\column(),
        'revision' => ['type' => 'bigint(20) unsigned'],
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
