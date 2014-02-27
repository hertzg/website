<?php

namespace Users;

function clearNumTokens ($mysqli, $idusers) {
    $sql = "update users set num_tokens = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
