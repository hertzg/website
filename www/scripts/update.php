#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = "update users set bar_charts_order_by = 'name, insert_time desc'"
    ." where bar_charts_order_by = 'name'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "update users set bookmarks_order_by = 'title, insert_time desc'"
    ." where bookmarks_order_by = 'title'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "update users set contacts_order_by = 'full_name, insert_time desc'"
    ." where contacts_order_by = 'full_name'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "update users set events_order_by = 'event_time desc, start_hour, start_minute, insert_time desc'"
    ." where events_order_by = 'event_time desc'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "update users set places_order_by = 'name, insert_time desc'"
    ." where places_order_by = 'name'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "update users set wallets_order_by = 'name, insert_time desc'"
    ." where wallets_order_by = 'name'";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "update users set wallets_order_by = 'balance, insert_time desc'"
    ." where wallets_order_by = 'balance'";
$mysqli->query($sql) || trigger_error($mysqli->error);

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
