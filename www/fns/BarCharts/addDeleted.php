<?php

namespace BarCharts;

function addDeleted ($mysqli, $id, $id_users, $name, $tags,
    $tag_names, $num_bars, $insert_time, $update_time, $revision) {

    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into bar_charts (id, id_users, name, tags, num_tags,'
        .' tags_json, num_bars, insert_time, update_time, revision)'
        ." values ($id, $id_users, '$name', '$tags', $num_tags,"
        ." '$tags_json', $num_bars, $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
