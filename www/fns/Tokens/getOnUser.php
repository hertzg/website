<?php

namespace Tokens;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $token = get($mysqli, $id);
    if ($token && $token->id_users == $id_users) return $token;
}
