#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

/*
include_once '../fns/get_absolute_base.php';
$url = get_absolute_base().'scripts/ensure-crontab.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_exec($ch);
*/

echo "Done\n";
