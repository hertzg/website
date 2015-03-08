<?php

namespace DeletedItems;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/column.php";
    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'deleted_items', [
        'data_json' => [
            'type' => 'text',
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'data_type' => [
            'type' => 'varchar(32)',
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => \ApiKeyName\column(true),
        'insert_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
