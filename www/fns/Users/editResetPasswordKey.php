<?php

namespace Users;

function editResetPasswordKey ($mysqli, $idusers, $resetpasswordkey) {
    $resetpasswordkey = mysqli_real_escape_string($mysqli, $resetpasswordkey);
    mysqli_query(
        $mysqli,
        "update users set resetpasswordkey = '$resetpasswordkey'"
        ." where idusers = $idusers"
    );
}
