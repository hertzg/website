<?php

namespace ReferencedCalculations;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from referenced_calculations where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
