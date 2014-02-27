<?php

namespace Users;

function editResetPasswordKey ($mysqli, $idusers, $resetpasswordkey) {
    $resetpasswordkey = $mysqli->real_escape_string($resetpasswordkey);
    $sql = "update users set resetpasswordkey = '$resetpasswordkey'"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
