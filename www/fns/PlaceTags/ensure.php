<?php

namespace PlaceTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Places/maxLengths.php";
    $maxLengths = \Places\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tag/maxLength.php";
    return \Table\ensure($mysqli, 'place_tags', [
        'description' => [
            'type' => "varchar($maxLengths[description])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_places' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
        ],
        'insert_time' => [
            'type' => 'bigint(20) unsigned',
        ],
        'latitude' => ['type' => 'double'],
        'longitude' => ['type' => 'double'],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'tags' => [
            'type' => "varchar($maxLengths[tags])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'tag_name' => [
            'type' => 'varchar('.\Tag\maxLength().')',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'update_time' => [
            'type' => 'bigint(20) unsigned',
        ],
    ]);

}
