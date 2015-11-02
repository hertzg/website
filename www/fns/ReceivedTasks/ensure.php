<?php

namespace ReceivedTasks;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tasks/maxLengths.php";
    $maxLengths = \Tasks\maxLengths();

    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_tasks', [
        'archived' => ['type' => 'tinyint(3) unsigned'],
        'deadline_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'receiver_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_address' => \ConnectionAddress\column(true),
        'sender_id_users' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'sender_username' => \Username\column(),
        'tags' => \Tags\column(),
        'text' => [
            'type' => "varchar($maxLengths[text])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'title' => [
            'type' => "varchar($maxLengths[title])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'top_priority' => ['type' => 'tinyint(3) unsigned'],
    ]);

}
