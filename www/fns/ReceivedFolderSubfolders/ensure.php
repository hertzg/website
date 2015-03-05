<?php

namespace ReceivedFolderSubfolders;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Folders/maxLengths.php";
    $maxLengths = \Folders\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'received_folder_subfolders', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_received_folders' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'parent_id' => ['type' => 'bigint(20) unsigned'],
    ]);

}
