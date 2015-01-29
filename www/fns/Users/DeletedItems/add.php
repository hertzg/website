<?php

namespace Users\DeletedItems;

function add ($mysqli, $id_users, $type, $data, $apiKey) {

    include_once __DIR__.'/../../DeletedItems/add.php';
    $id = \DeletedItems\add($mysqli, $id_users, $type, $data, $apiKey);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
