<?php

namespace Users\Calculations;

function addNumber ($mysqli, $id_users, $num_calculations) {
    $sql = "update users set num_calculations = num_calculations + $num_calculations"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
