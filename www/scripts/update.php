<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table contacts add favorite tinyint unsigned not null after tags') || trigger_error($mysqli->error);
$mysqli->query('alter table contact_tags add favorite tinyint unsigned not null after alias') || trigger_error($mysqli->error);
$mysqli->query('alter table received_contacts add favorite tinyint unsigned not null after tags') || trigger_error($mysqli->error);
echo "Done\n";
