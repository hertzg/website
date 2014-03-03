<?php

namespace Users;

function invalidateEmail ($mysqli, $idusers) {
    $sql = 'update users set verify_email_key = null, email_verified = 0,'
        ." verify_email_key_time = null where idusers = $idusers";
    $mysqli->query($sql);
}
