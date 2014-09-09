#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once '../../../fns/Feedbacks/maxLengths.php';
$maxLengths = Feedbacks\maxLengths();

include_once 'fns/ensure_table.php';
ensure_table('feedbacks', [
    'idfeedbacks' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'id_users' => [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
    'text' => [
        'type' => "varchar($maxLengths[text])",
        'characterSet' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
]);
