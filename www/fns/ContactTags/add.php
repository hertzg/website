<?php

namespace ContactTags;

function add ($mysqli, $id_users, $id_contacts, array $tag_names,
    $full_name, $alias, $phone1, $phone2, $favorite) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    $favorite = $favorite ? '1' : '0';
    $insert_time = $update_time = time();

    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into contact_tags'
            .' (id_users, id_contacts, tag_name, full_name,'
            .' alias, phone1, phone2, favorite,'
            .' insert_time, update_time)'
            ." values ($id_users, $id_contacts, '$tag_name', '$full_name',"
            ." '$alias', '$phone1', '$phone2', $favorite,"
            ." $insert_time, $update_time)";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}
