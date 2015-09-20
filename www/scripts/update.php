#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = "update users set bar_charts_order_by = 'update_time desc',"
    ." bookmarks_order_by = 'update_time desc',"
    ." contacts_order_by = 'full_name',"
    ." events_order_by = 'event_time desc',"
    ." notes_order_by = 'update_time desc',"
    ." places_order_by = 'update_time desc',"
    ." schedules_order_by = 'update_time desc',"
    ." tasks_order_by = 'update_time desc',"
    ." wallets_order_by = 'update_time desc'";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
