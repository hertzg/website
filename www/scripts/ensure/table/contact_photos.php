#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/require-cli.php';

include_once 'fns/ensure_table.php';
include_once '../../../fns/Tag/maxLength.php';
ensure_table('contact_photos', [
    'id' => [
        'type' => 'bigint(20) unsigned',
        'primary' => true,
    ],
    'num_refs' => [
        'type' => 'bigint(20) unsigned',
        'default' => '1',
    ],
    'insert_time' => [
        'type' => 'bigint(20) unsigned',
    ],
]);

