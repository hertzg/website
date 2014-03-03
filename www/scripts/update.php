<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users add verify_email_key_time bigint unsigned');
