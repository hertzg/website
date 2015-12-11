<?php

namespace CalculationDepends;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from calculation_depends where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
