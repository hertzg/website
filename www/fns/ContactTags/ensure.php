<?php

namespace ContactTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Contacts/maxLengths.php";
    $maxLengths = \Contacts\maxLengths();

    include_once "$fnsDir/Email/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tag/maxLength.php";
    return \Table\ensure($mysqli, 'contact_tags', [
        'alias' => [
            'type' => "varchar($maxLengths[alias])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'email' => \Email\column(),
        'favorite' => ['type' => 'tinyint(3) unsigned'],
        'full_name' => [
            'type' => "varchar($maxLengths[full_name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_contacts' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'phone1' => [
            'type' => "varchar($maxLengths[phone1])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'phone2' => [
            'type' => "varchar($maxLengths[phone2])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_general_ci',
        ],
        'tag_name' => [
            'type' => 'varchar('.\Tag\maxLength().')',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
