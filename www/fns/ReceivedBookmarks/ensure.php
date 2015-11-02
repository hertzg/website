<?php

namespace ReceivedBookmarks;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Bookmarks/maxLengths.php";
    $maxLengths = \Bookmarks\maxLengths();

    include_once "$fnsDir/ConnectionAddress/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'received_bookmarks', [
        'archived' => ['type' => 'tinyint(3) unsigned'],
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
        'title' => [
            'type' => "varchar($maxLengths[title])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'url' => [
            'type' => "varchar($maxLengths[url])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ]);

}
