<?php

namespace Calculations;

function delete ($mysqli, $id) {
    $sql = "delete from calculations where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
