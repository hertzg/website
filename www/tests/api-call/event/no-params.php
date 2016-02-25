#!/usr/bin/php
<?php

include_once '../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('event/add');
$engine->expectError('ENTER_TEXT');

$response = $engine->request('event/delete');
$engine->expectError('EVENT_NOT_FOUND');

$response = $engine->request('event/edit');
$engine->expectError('EVENT_NOT_FOUND');

$response = $engine->request('event/get');
$engine->expectError('EVENT_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
