<?php

namespace BarChartBars;

function add ($mysqli, $id_users,
    $id_bar_charts, $value, $label, $insertApiKey) {

    $label = $mysqli->real_escape_string($label);
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into bar_chart_bars'
        .' (id_users, id_bar_charts, value, label, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, $id_bar_charts, $value, '$label', $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
