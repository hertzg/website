<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'alter table tasks'
    .' drop done,'
    .' add top_priority tinyint not null'
) || die($mysqli->error);

$mysqli->query(
    'alter table tasktags'
    .' drop done,'
    .' add top_priority tinyint not null'
) || die($mysqli->error);

echo 'Done';
