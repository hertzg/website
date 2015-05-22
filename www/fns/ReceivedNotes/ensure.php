<?php

namespace ReceivedNotes;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Notes/maxLengths.php";
    $maxLengths = \Notes\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_notes', [
        'archived' => ['type' => 'tinyint(3) unsigned'],
        'encrypt' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'receiver_id_users' => ['type' => 'bigint(20) unsigned'],
        'sender_id_users' => ['type' => 'bigint(20) unsigned'],
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
    ]);

}
