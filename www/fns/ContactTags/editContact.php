<?php

namespace ContactTags;

function editContact ($mysqli, $id_contacts, $full_name,
    $alias, $email1, $email1_label, $email2, $email2_label,
    $phone1, $phone1_label, $phone2, $phone2_label,
    $photo_id, $favorite, $insert_time, $update_time) {

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
    if ($photo_id === null) $photo_id = 'null';
    $favorite = $favorite ? '1' : '0';

    $sql = "update contact_tags set full_name = '$full_name',"
        ." alias = '$alias', email1 = '$email1',"
        ." email1_label = '$email1_label', email2 = '$email2',"
        ." email2_label = '$email2_label',"
        ." phone1 = '$phone1', phone1_label = '$phone1_label',"
        ." phone2 = '$phone2', phone2_label = '$phone2_label',"
        ." photo_id = $photo_id, favorite = $favorite,"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_contacts = $id_contacts";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
