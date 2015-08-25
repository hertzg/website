<?php

namespace BarChartTags;

function editBarChart ($mysqli, $id_bar_charts,
    $name, $tags, $tag_names, $insert_time, $update_time) {

    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = "update bar_chart_tags set name = '$name', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_bar_charts = $id_bar_charts";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
