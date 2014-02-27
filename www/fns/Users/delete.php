<?php

namespace Users;

function delete ($mysqli, $idusers) {
    $mysqli->query("delete from users where idusers = $idusers");
    rmdir(__DIR__."/../../users/$idusers");
}
