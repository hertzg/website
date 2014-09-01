#!/usr/bin/php
<?php

include_once 'fns/ensure_table.php';
ensure_table('contact_tags', [
    'alias' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'favorite' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'full_name' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_contacts' => [
        'type' => 'bigint(20) unsigned',
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'phone1' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'phone2' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'tag_name' => [
        'type' => 'varchar(64)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
]);
