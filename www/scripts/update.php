<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users add password_salt varbinary(32) not null after password_hash');
