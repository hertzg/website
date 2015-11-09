#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

/*
include_once '../fns/DomainName/get.php';
include_once '../fns/SiteBase/get.php';
include_once '../fns/SiteProtocol/get.php';
$url = SiteProtocol\get().'://'.DomainName\get().SiteBase\get().'scripts/ensure-crontab.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_exec($ch);
*/

echo "Done\n";
