#!/usr/bin/php
<?php

chdir(__DIR__);

include_once '../classes/Engine.php';
$engine = new Engine;

$response = $engine->request('notification/post');
$engine->expectError('CHANNEL_NOT_FOUND');

echo 'Done '.__FILE__."\n  $engine->numRequests requests made.\n";
