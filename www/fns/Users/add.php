<?php

namespace Users;

function add ($mysqli, $username, $password) {

    include_once __DIR__.'/../Password/hash.php';
    list($password_hash, $password_salt) = \Password\hash($password);

    include_once __DIR__.'/Home/defaultOrder.php';
    $order_home_items = Home\defaultOrder();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $username = $mysqli->real_escape_string($username);
    $password_hash = $mysqli->real_escape_string($password_hash);
    $password_salt = $mysqli->real_escape_string($password_salt);
    $insert_time = time();

    $sql = 'insert into users (username, password_hash,'
        .' password_salt, order_home_items, insert_time)'
        ." values ('$username', '$password_hash',"
        ." '$password_salt', '$order_home_items', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id_users = $mysqli->insert_id;

    $userDir = __DIR__."/../../users/$id_users";
    mkdir($userDir);
    mkdir("$userDir/files");
    mkdir("$userDir/received-files");
    mkdir("$userDir/received-folder-files");

}
