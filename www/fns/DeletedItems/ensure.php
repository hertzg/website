<?php

namespace DeletedItems;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
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
        'id_users' => [
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
    ]);

}
