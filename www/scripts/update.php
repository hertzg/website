<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users add num_logins bigint unsigned');
$mysqli->query('update users set num_logins = 1');
