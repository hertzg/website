<?php

namespace ReceivedFolderSubfolders;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/FileName/column.php";
    $nameColumn = \FileName\column();

    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'received_folder_subfolders', [
        'deleted' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_received_folders' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'name' => $nameColumn,
        'parent_id' => ['type' => 'bigint(20) unsigned'],
        'received_folder_name' => $nameColumn,
    ]);

}
