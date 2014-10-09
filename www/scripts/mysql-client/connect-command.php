#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../fns/get_mysqli_config.php';

get_mysqli_config($host, $username, $password, $db);
echo "mysql -h$host -u$username -p$password $db\n";
