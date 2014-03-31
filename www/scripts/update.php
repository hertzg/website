<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table contacts add username varchar(32) character set ascii collate ascii_bin after phone2');
