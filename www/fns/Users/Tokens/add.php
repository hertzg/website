<?php

namespace Users\Tokens;

function add ($mysqli, $id_users, $username, $token_text, $user_agent) {

    include_once __DIR__.'/../../Tokens/add.php';
    $id = \Tokens\add($mysqli, $id_users, $username, $token_text, $user_agent);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
