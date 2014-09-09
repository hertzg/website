#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
ensure_table('contacts', [
    'address' => [
        'type' => 'varchar(128)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'alias' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'birthday_day' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'birthday_month' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'birthday_time' => [
        'type' => 'bigint(20)',
        'nullable' => true,
    ],
    'email' => [
        'type' => 'varchar(64)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'favorite' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'full_name' => [
        'type' => 'varchar(32)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'id_contacts' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'num_edits' => [
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
    'tags' => [
        'type' => 'varchar(256)',
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'timezone' => [
        'type' => 'int(11)',
        'nullable' => true,
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'username' => [
        'type' => 'varchar(32)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
