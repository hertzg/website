<?php

namespace ContactTags;

function add ($mysqli, $id_users, $id_contacts, $tag_names,
    $full_name, $alias, $email1, $email1_label, $email2,
    $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $favorite, $insert_time, $update_time) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $email1 = $mysqli->real_escape_string($email1);
    $email1_label = $mysqli->real_escape_string($email1_label);
    $email2 = $mysqli->real_escape_string($email2);
    $email2_label = $mysqli->real_escape_string($email2_label);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone1_label = $mysqli->real_escape_string($phone1_label);
    $phone2 = $mysqli->real_escape_string($phone2);
    $phone2_label = $mysqli->real_escape_string($phone2_label);
    $favorite = $favorite ? '1' : '0';

    $sql = 'insert into contact_tags'
        .' (id_users, id_contacts, tag_name, full_name,'
        .' alias, email1, email1_label, email2,'
        .' email2_label, phone1, phone1_label,'
        .' phone2, phone2_label, favorite,'
        .' insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_contacts, '$tag_name', '$full_name',"
            ." '$alias', '$email1', '$email1_label', '$email2',"
            ." '$email2_label', '$phone1', '$phone1_label',"
            ." '$phone2', '$phone2_label', $favorite,"
            ." $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
