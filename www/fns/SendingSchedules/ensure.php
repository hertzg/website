<?php

namespace SendingSchedules;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Schedules/maxLengths.php";
    $maxLengths = \Schedules\maxLengths();

    include_once "$fnsDir/Username/column.php";
    $usernameColumn = \Username\column();

    include_once "$fnsDir/ApiKey/column.php";
    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    return \Table\ensure($mysqli, 'sending_schedules', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_admin_connections' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'interval' => ['type' => 'bigint(20) unsigned'],
        'num_fails' => ['type' => 'bigint(20) unsigned'],
        'offset' => ['type' => 'bigint(20) unsigned'],
        'receiver_address' => \ConnectionAddress\column(),
        'receiver_username' => $usernameColumn,
        'sender_username' => $usernameColumn,
        'tags' => \Tags\column(),
        'their_exchange_api_key' => \ApiKey\column(),
        'text' => [
            'type' => "varchar($maxLengths[text])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ]);

}
