<?php

include_once '../lib/mysqli.php';

function query ($sql) {
    global $mysqli;
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
query('alter table contacts change fullname full_name varchar(32) character set utf8 collate utf8_unicode_ci');
query('alter table contacttags change fullname full_name varchar(32) character set utf8 collate utf8_unicode_ci');
echo 'Done';
