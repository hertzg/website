<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table api_keys add num_edits bigint unsigned not null');
$mysqli->query('alter table bookmarks add num_edits bigint unsigned not null');
$mysqli->query('alter table channels add num_edits bigint unsigned not null');
$mysqli->query('alter table connections add num_edits bigint unsigned not null');
$mysqli->query('alter table contacts add num_edits bigint unsigned not null');
$mysqli->query('alter table events add num_edits bigint unsigned not null');
$mysqli->query('alter table schedules add num_edits bigint unsigned not null');
$mysqli->query('alter table tasks add num_edits bigint unsigned not null');

$mysqli->query('update api_keys set num_edits = 1 where update_time > insert_time');
$mysqli->query('update bookmarks set num_edits = 1 where update_time > insert_time');
$mysqli->query('update channels set num_edits = 1 where update_time > insert_time');
$mysqli->query('update connections set num_edits = 1 where update_time > insert_time');
$mysqli->query('update contacts set num_edits = 1 where update_time > insert_time');
$mysqli->query('update events set num_edits = 1 where update_time > insert_time');
$mysqli->query('update notes set num_edits = 1 where update_time > insert_time');
$mysqli->query('update schedules set num_edits = 1 where update_time > insert_time');
$mysqli->query('update tasks set num_edits = 1 where update_time > insert_time');
