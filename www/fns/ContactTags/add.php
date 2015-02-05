<?php

namespace ContactTags;

function add ($mysqli, $id_users, $id_contacts, $tag_names,
    $full_name, $alias, $email, $phone1, $phone2, $favorite) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone2 = $mysqli->real_escape_string($phone2);
    $favorite = $favorite ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into contact_tags'
        .' (id_users, id_contacts, tag_name, full_name,'
        .' alias, email, phone1, phone2, favorite,'
        .' insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_contacts, '$tag_name', '$full_name',"
            ." '$alias', '$email', '$phone1', '$phone2', $favorite,"
            ." $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
