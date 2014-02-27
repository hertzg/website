<?php

include_once '../lib/mysqli.php';

$sql = 'alter table users'
    .' add num_bookmarks bigint unsigned not null,'
    .' add num_channels bigint unsigned not null,'
    .' add num_contacts bigint unsigned not null,'
    .' add num_events bigint unsigned not null,'
    .' add num_notes bigint unsigned not null,'
    .' add num_tasks bigint unsigned not null,'
    .' add num_tokens bigint unsigned not null';
$mysqli->query($sql);

include_once 'update-num-items.php';

echo 'Done';
