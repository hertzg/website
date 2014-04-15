<?php

chdir(__DIR__);

include_once '../lib/mysqli.php';

$mysqli->query('alter table subscribed_channels'
    .' change subscriber_id_users subscriber_id_users bigint unsigned not null') || trigger_error($mysqli->error);
