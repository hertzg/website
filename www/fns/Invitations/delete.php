<?php

namespace Invitations;

function delete ($mysqli, $id) {
    $sql = "delete from invitations where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
