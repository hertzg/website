<?php

namespace BookmarkTags;

function ensure ($mysqli) {

    include_once __DIR__.'/../Bookmarks/maxLengths.php';
    $maxLengths = \Bookmarks\maxLengths();

    include_once __DIR__.'/../Table/ensure.php';
    include_once __DIR__.'/../Tag/maxLength.php';
    return \Table\ensure($mysqli, 'bookmark_tags', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_bookmarks' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'tag_name' => [
            'type' => 'varchar('.\Tag\maxLength().')',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'title' => [
            'type' => "varchar($maxLengths[title])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'url' => [
            'type' => "varchar($maxLengths[url])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ]);

}
