<?php

namespace Users\ApiKeys;

function add ($mysqli, $id_users, $name) {

    include_once __DIR__.'/../../ApiKeys/add.php';
    \ApiKeys\add($mysqli, $id_users, $name);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
