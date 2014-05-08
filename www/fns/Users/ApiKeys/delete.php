<?php

namespace Users\ApiKeys;

function delete ($mysqli, $apiKey) {

    include_once __DIR__.'/../../ApiKeys/delete.php';
    \ApiKeys\delete($mysqli, $apiKey->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $apiKey->id_users, -1);

}
