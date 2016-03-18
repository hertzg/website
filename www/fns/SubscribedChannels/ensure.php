<?php

namespace SubscribedChannels;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    $nullable_unsigned_bigint = [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ];

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/ChannelName/column.php";
    $channelNameColumn = \ChannelName\column();

    include_once "$fnsDir/Username/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'subscribed_channels', [
        'channel_name' => $channelNameColumn,
        'channel_public' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_channels' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => $nullable_unsigned_bigint,
        'insert_api_key_name' => $apiKeyNameColumn,
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'lowercase_name' => $channelNameColumn,
        'num_notifications' => ['type' => 'bigint(20) unsigned'],
        'publisher_id_users' => ['type' => 'bigint(20) unsigned'],
        'publisher_locked' => ['type' => 'tinyint(3) unsigned'],
        'publisher_username' => \Username\column(),
        'receive_notifications' => ['type' => 'tinyint(3) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'subscriber_id_users' => ['type' => 'bigint(20) unsigned'],
        'subscriber_locked' => ['type' => 'tinyint(3) unsigned'],
        'subscriber_username' => \Username\column(),
        'update_api_key_id' => $nullable_unsigned_bigint,
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
