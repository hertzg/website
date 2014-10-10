#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';

include_once '../../../fns/Contacts/maxLengths.php';
$maxLengths = Contacts\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('contacts', [
    'address' => [
        'type' => "varchar($maxLengths[address])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'alias' => [
        'type' => "varchar($maxLengths[alias])",
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
        'type' => "varchar($maxLengths[email])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'favorite' => [
        'type' => 'tinyint(3) unsigned',
    ],
    'full_name' => [
        'type' => "varchar($maxLengths[full_name])",
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
        'type' => "varchar($maxLengths[phone1])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'phone2' => [
        'type' => "varchar($maxLengths[phone2])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_general_ci',
    ],
    'photo_id' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'tags' => [
        'type' => "varchar($maxLengths[tags])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'tags_json' => [
        'type' => "varchar($maxLengths[tags_json])",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
    'timezone' => [
        'type' => 'int(11)',
        'nullable' => true,
    ],
    'update_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'username' => [
        'type' => "varchar($maxLengths[username])",
        'characterSet' => 'ascii',
        'collation' => 'ascii_bin',
    ],
]);
