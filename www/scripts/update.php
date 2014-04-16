<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table subscribed_channels add channel_public tinyint not null');
