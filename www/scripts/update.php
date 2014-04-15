<?php

chdir(__DIR__);

include_once '../lib/mysqli.php';

$mysqli->query('alter table subscribed_channels'
    .' change id_users publisher_id_users bigint unsigned not null,'
    .' change username publisher_username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,'
    .' change subscribed_id_users subscriber_id_users bigint unsigned not null,'
    .' change subscribed_username subscriber_username varchar(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL') || trigger_error($mysqli->error);
