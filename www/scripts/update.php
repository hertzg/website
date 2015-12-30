#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = 'update users set events_order_by = '
    ."'event_time desc, start_hour, start_minute, insert_time desc'"
    ." where events_order_by = 'event_time desc'";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
