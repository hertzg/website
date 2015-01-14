<?php

namespace DeletedFolders;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Folders/maxLengths.php";
    $maxLengths = \Folders\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'deleted_folders', [
        'id_deleted_items' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_folders' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'parent_id_folders' => [
            'type' => 'bigint(20) unsigned',
        ],
        'rename_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'revision' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
