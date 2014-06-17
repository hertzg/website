<?php

namespace Users\DeletedItems;

function add ($mysqli, $id_users, $type, $data) {

    include_once __DIR__.'/../../DeletedItems/add.php';
    \DeletedItems\add($mysqli, $id_users, $type, $data);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
