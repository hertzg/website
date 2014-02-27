<?php

namespace Users;

function addNumTokens ($mysqli, $idusers, $num_tokens) {
    $sql = "update users set num_tokens = num_tokens + $num_tokens"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
