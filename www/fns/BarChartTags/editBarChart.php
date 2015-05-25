<?php

namespace BarChartTags;

function editBarChart ($mysqli, $id_bar_charts,
    $name, $tags, $insert_time, $update_time) {

    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);

    $sql = "update bar_chart_tags set name = '$name', tags = '$tags',"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_bar_charts = $id_bar_charts";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
