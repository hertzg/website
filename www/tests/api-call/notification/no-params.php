#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('notification/post');
$engine->expectError('CHANNEL_NOT_FOUND');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
