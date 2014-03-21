<?php

include_once '../lib/mysqli.php';

function query ($sql) {
    global $mysqli;
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
query('alter table bookmarks change inserttime insert_time bigint unsigned not null');
query('alter table bookmarks change updatetime update_time bigint unsigned not null');
query('alter table bookmarktags change inserttime insert_time bigint unsigned not null');
query('alter table bookmarktags change updatetime update_time bigint unsigned not null');
query('alter table channels change inserttime insert_time bigint unsigned not null');
query('alter table feedbacks change inserttime insert_time bigint unsigned not null');
query('alter table files change inserttime insert_time bigint unsigned not null');
query('alter table folders change inserttime insert_time bigint unsigned not null');
query('alter table notes change inserttime insert_time bigint unsigned not null');
query('alter table notes change updatetime update_time bigint unsigned not null');
query('alter table notetags change inserttime insert_time bigint unsigned not null');
query('alter table notetags change updatetime update_time bigint unsigned not null');
query('alter table notifications change inserttime insert_time bigint unsigned not null');
query('alter table tasks change inserttime insert_time bigint unsigned not null');
query('alter table tasks change updatetime update_time bigint unsigned not null');
query('alter table tasktags change inserttime insert_time bigint unsigned not null');
query('alter table tasktags change updatetime update_time bigint unsigned not null');
query('alter table tokens change inserttime insert_time bigint unsigned not null');
query('alter table tokens change accesstime access_time bigint unsigned not null');
echo 'Done';
