<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users add num_new_notifications_for_home bigint unsigned not null after num_new_notifications') || die($mysqli->error);

echo 'Done';
