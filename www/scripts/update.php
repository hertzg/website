<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table subscribed_channels change public_subscriber subscriber_locked tinyint not null after subscriber_username');
$mysqli->query('alter table subscribed_channels add publisher_locked tinyint not null after publisher_username');
$mysqli->query('update subscribed_channels set publisher_locked = 1 where subscriber_locked = 0');
