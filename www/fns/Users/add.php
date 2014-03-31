<?php

namespace Users;

function add ($mysqli, $username, $email, $password) {

    include_once __DIR__.'/../Password/hash.php';
    list($password_hash, $password_salt) = \Password\hash($password);

    include_once __DIR__.'/../get_default_order_home_items.php';
    $order_home_items = get_default_order_home_items();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $username = $mysqli->real_escape_string($username);
    $email = $mysqli->real_escape_string($email);
    $password_hash = $mysqli->real_escape_string($password_hash);
    $password_salt = $mysqli->real_escape_string($password_salt);
    $insert_time = time();

    $sql = 'insert into users (username, email, password_hash,'
        .' password_salt, order_home_items, insert_time)'
        ." values ('$username', '$email', '$password_hash',"
        ." '$password_salt', '$order_home_items', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id_users = $mysqli->insert_id;

    mkdir(__DIR__."/../../users/$id_users");
    mkdir(__DIR__."/../../users/$id_users/files");

}
