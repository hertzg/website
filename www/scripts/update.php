<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'alter table users'
    .' add verify_email_key binary(16),'
    .' add email_verified tinyint not null'
);
$mysqli->query('update users set num_logins = 1');
