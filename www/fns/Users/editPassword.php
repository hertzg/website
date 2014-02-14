<?php

namespace Users;

function editPassword ($mysqli, $idusers, $password) {
    $password = mysqli_real_escape_string($mysqli, md5($password, true));
    mysqli_query(
        $mysqli,
        'update users set'
        ." password = '$password',"
        .' resetpasswordkey = null'
        ." where idusers = $idusers"
    );
}
