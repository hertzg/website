<?php

namespace Users;

function add ($mysqli, $username, $email, $password) {

    include_once __DIR__.'/../Password/hash.php';
    $password_hash = \Password\hash($password);
    $password_hash = $mysqli->real_escape_string($password_hash);

    include_once __DIR__.'/../get_default_order_home_items.php';
    $order_home_items = get_default_order_home_items();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $username = $mysqli->real_escape_string($username);
    $email = $mysqli->real_escape_string($email);
    $inserttime = time();
    $sql = 'insert into users (username, email,'
        .' password_hash, order_home_items, inserttime)'
        ." values ('$username', '$email',"
        ." '$password_hash', '$order_home_items', $inserttime)";
    $mysqli->query($sql);
    $idusers = $mysqli->insert_id;
    mkdir(__DIR__."/../../users/$idusers");

}
