#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('notification/post');
$engine->expectError('ENTER_CHANNEL_NAME');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
