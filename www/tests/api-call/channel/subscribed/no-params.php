#!/usr/bin/php
<?php

include_once '../../../../../lib/defaults.php';

chdir(__DIR__);

include_once '../../fns/get_main_engine.php';
$engine = get_main_engine();

$response = $engine->request('channel/subscribed/edit');
$engine->expectError('SUBSCRIBED_CHANNEL_NOT_FOUND');

$response = $engine->request('channel/subscribed/get');
$engine->expectError('SUBSCRIBED_CHANNEL_NOT_FOUND');

$response = $engine->request('channel/subscribed/subscribe');
$engine->expectError('ENTER_CHANNEL_NAME');

$response = $engine->request('channel/subscribed/unsubscribe');
$engine->expectError('SUBSCRIBED_CHANNEL_NOT_FOUND');

echo 'Done '.__FILE__."\n $engine->numRequests requests made.\n";
