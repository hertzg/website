<?php

namespace Tokens;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from tokens where idusers = $idusers");
}
