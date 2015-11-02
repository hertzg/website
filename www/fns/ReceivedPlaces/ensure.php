<?php

namespace ReceivedPlaces;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Places/maxLengths.php";
    $maxLengths = \Places\maxLengths();

    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_places', [
        'altitude' => [
            'type' => 'double',
            'nullable' => true,
        ],
        'archived' => ['type' => 'tinyint(3) unsigned'],
        'description' => [
            'type' => "varchar($maxLengths[description])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'latitude' => ['type' => 'double'],
        'longitude' => ['type' => 'double'],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'receiver_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_address' => \ConnectionAddress\column(true),
        'sender_id_users' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'sender_username' => \Username\column(),
        'tags' => \Tags\column(),
    ]);

}
