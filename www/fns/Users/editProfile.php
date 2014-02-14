<?php

namespace Users;

function editProfile ($mysqli, $idusers, $email, $fullname) {
    $email = mysqli_real_escape_string($mysqli, $email);
    $fullname = mysqli_real_escape_string($mysqli, $fullname);
    mysqli_query(
        $mysqli,
        'update users set'
        ." email = '$email',"
        ." fullname = '$fullname'"
        ." where idusers = $idusers"
    );
}
