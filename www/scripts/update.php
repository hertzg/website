<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table contacts add birth_time bigint unsigned default null after phone2') || trigger_error($mysqli->error);
$mysqli->query('alter table contacts add birth_day bigint unsigned default null after birth_time') || trigger_error($mysqli->error);
$mysqli->query('alter table contacts add birth_month bigint unsigned default null after birth_day') || trigger_error($mysqli->error);
$mysqli->query('alter table users add num_birthdays_today bigint unsigned not null after anonymous_can_send_task') || trigger_error($mysqli->error);
$mysqli->query('alter table users add num_birthdays_tomorrow bigint unsigned not null after num_birthdays_today') || trigger_error($mysqli->error);
echo "Done\n";
