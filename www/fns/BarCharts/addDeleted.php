<?php

namespace BarCharts;

function addDeleted ($mysqli, $id, $id_users, $name,
    $num_bars, $insert_time, $update_time, $revision) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into bar_charts (id, id_users, name,'
        .' num_bars, insert_time, update_time, revision)'
        ." values ($id, $id_users, '$name',"
        ." $num_bars, $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
