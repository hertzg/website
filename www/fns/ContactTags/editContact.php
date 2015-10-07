<?php

namespace ContactTags;

function editContact ($mysqli, $id_contacts,
    $full_name, $alias, $email, $phone1, $phone1_label, $phone2,
    $phone2_label, $favorite, $insert_time, $update_time) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $email = $mysqli->real_escape_string($email);
    $phone1 = $mysqli->real_escape_string($phone1);
    $phone1_label = $mysqli->real_escape_string($phone1_label);
    $phone2 = $mysqli->real_escape_string($phone2);
    $phone2_label = $mysqli->real_escape_string($phone2_label);
    $favorite = $favorite ? '1' : '0';

    $sql = "update contact_tags set full_name = '$full_name',"
        ." alias = '$alias', email = '$email', phone1 = '$phone1',"
        ." phone1_label = '$phone1_label', phone2 = '$phone2',"
        ." phone2_label = '$phone2_label', favorite = $favorite,"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_contacts = $id_contacts";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
