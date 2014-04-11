<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table connections add can_send_file tinyint unsigned not null after can_send_contact') || trigger_error($mysqli->error);
$mysqli->query('alter table users add anonymous_can_send_file tinyint unsigned not null after anonymous_can_send_contact') || trigger_error($mysqli->error);
echo 'Done';
