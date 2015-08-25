<?php

namespace NoteTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Notes/maxLengths.php";
    $maxLengths = \Notes\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/TagName/column.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    return \Table\ensure($mysqli, 'note_tags', [
        'encrypt_in_listings' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_notes' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'num_tags' => ['type' => 'tinyint(3) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'tag_name' => \TagName\column(),
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
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
