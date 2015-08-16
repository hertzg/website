<?php

namespace Invitations;

function edit ($mysqli, $id, $note) {

    $note = $mysqli->real_escape_string($note);
    $update_time = time();

    $sql = "update invitations set note = '$note', update_time = $update_time,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
