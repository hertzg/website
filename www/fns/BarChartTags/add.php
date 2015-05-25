<?php

namespace BarChartTags;

function add ($mysqli, $id_users, $id_bar_charts, $tag_names, $name, $tags) {

    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();

    $sql = 'insert into bar_chart_tags (id_users, id_bar_charts, tag_name,'
        .' name, tags, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_bar_charts, '$tag_name',"
            ." '$name', '$tags', $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
