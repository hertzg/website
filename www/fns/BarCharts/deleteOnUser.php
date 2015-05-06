<?php

namespace BarCharts;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from bar_charts where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
