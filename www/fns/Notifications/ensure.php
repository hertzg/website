<?php

namespace Notifications;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/column.php";
    include_once "$fnsDir/ChannelName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'notifications', [
        'channel_name' => \ChannelName\column(),
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_channels' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id_subscribed_channels' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => \ApiKeyName\column(true),
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'text' => [
            'type' => "varchar($maxLengths[text])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ]);

}
