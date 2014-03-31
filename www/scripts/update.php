<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table events change id_events id bigint unsigned not null auto_increment');
