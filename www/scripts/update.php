#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

include_once '../fns/mysqli_query_object.php';
$users = mysqli_query_object($mysqli, 'select * from users');

include_once '../fns/mysqli_single_object.php';
foreach ($users as $user) {

    $id_users = $user->id_users;
    $sql = "select * from signins where id_users = $id_users"
        .' order by insert_time desc';
    $signin = mysqli_single_object($mysqli, $sql);

    if ($signin) {
        $remote_address = $mysqli->real_escape_string($signin->remote_address);
        $sql = 'update users set'
            ." last_signin_remote_address = '$remote_address'"
            ." where id_users = $id_users";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}

echo "Done\n";
