<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table channels add public tinyint not null');
$mysqli->query('alter table subscribed_channels add public_subscriber tinyint not null');
