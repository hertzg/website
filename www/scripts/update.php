<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users change password password_hash binary(16) not null');
