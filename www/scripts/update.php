<?php

include_once '../lib/mysqli.php';

function query ($sql) {
    global $mysqli;
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
query('alter table bookmarktags change idbookmarktags id bigint unsigned auto_increment not null');
query('alter table contacttags change idcontacttags id bigint unsigned auto_increment not null');
query('alter table notetags change idnotetags id bigint unsigned auto_increment not null');
query('alter table tasktags change idtasktags id bigint unsigned auto_increment not null');
echo 'Done';
