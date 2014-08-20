<?php

namespace Users\ApiKeys;

function add ($mysqli, $id_users, $name, $expire_time) {

    include_once __DIR__.'/../../ApiKeys/add.php';
    $id = \ApiKeys\add($mysqli, $id_users, $name, $expire_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
