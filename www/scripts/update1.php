<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'alter table users'
    .' change resetpasswordkey reset_password_key binary(16),'
    .' add reset_password_key_time bigint unsigned'
);
