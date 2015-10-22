<?php

namespace Users\Tokens;

function delete ($mysqli, $token) {

    include_once __DIR__.'/../../Tokens/delete.php';
    \Tokens\delete($mysqli, $token->id);

    include_once __DIR__.'/../../TokenAuths/deleteOnToken.php';
    \TokenAuths\deleteOnToken($mysqli, $token->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $token->id_users, -1);

}
