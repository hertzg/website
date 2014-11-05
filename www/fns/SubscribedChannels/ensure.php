<?php

namespace SubscribedChannels;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
    return \Table\ensure($mysqli, 'subscribed_channels', [
        'channel_name' => [
            'type' => "varchar($maxLengths[channel_name])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_general_ci',
        ],
        'channel_public' => [
            'type' => 'tinyint(4)',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_channels' => [
            'type' => 'bigint(20) unsigned',
        ],
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
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'lowercase_name' => [
            'type' => "varchar($maxLengths[lowercase_name])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_general_ci',
        ],
        'num_notifications' => [
            'type' => 'bigint(20) unsigned',
        ],
        'publisher_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'publisher_locked' => [
            'type' => 'tinyint(4)',
        ],
        'publisher_username' => [
            'type' => "varchar($maxLengths[username])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
        'receive_notifications' => [
            'type' => 'tinyint(4)',
        ],
        'subscriber_id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'subscriber_locked' => [
            'type' => 'tinyint(4)',
        ],
        'subscriber_username' => [
            'type' => "varchar($maxLengths[username])",
            'characterSet' => 'ascii',
            'collation' => 'ascii_bin',
        ],
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
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
