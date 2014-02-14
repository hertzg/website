<?php

namespace Users;

function delete ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from users where idusers = $idusers");
    rmdir(__DIR__."/../../users/$idusers");
}
