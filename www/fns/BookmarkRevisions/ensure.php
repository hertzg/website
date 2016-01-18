<?php

namespace BookmarkRevisions;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Bookmarks/maxLengths.php";
    $maxLengths = \Bookmarks\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    return \Table\ensure($mysqli, 'bookmark_revisions', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_bookmarks' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
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
