<?php

namespace Tokens;

function getOnUser ($mysqli, $idusers, $id) {
    include_once __DIR__.'/get.php';
    $token = get($mysqli, $id);
    if ($token && $token->idusers == $idusers) return $token;
}
