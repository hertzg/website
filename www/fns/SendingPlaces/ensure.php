<?php

namespace SendingPlaces;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Places/maxLengths.php";
    $maxLengths = \Places\maxLengths();

    include_once "$fnsDir/Username/column.php";
    $usernameColumn = \Username\column();

    include_once "$fnsDir/ApiKey/column.php";
    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    return \Table\ensure($mysqli, 'sending_places', [
        'altitude' => [
            'type' => 'double',
            'nullable' => true,
        ],
        'description' => [
            'type' => "varchar($maxLengths[description])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_admin_connections' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'latitude' => ['type' => 'double'],
        'longitude' => ['type' => 'double'],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'num_fails' => ['type' => 'bigint(20) unsigned'],
        'receiver_address' => \ConnectionAddress\column(),
        'receiver_username' => $usernameColumn,
        'sender_username' => $usernameColumn,
        'tags' => \Tags\column(),
        'their_exchange_api_key' => \ApiKey\column(),
    ]);

}
