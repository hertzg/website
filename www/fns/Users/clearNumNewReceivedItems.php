<?php

namespace Users;

function clearNumNewReceivedItems ($mysqli, $id_users) {
    $sql = 'update users set home_num_new_received_bookmarks = 0,'
        .' home_num_new_received_contacts = 0,'
        .' home_num_new_received_files = 0,'
        .' home_num_new_received_folders = 0,'
        .' home_num_new_received_notes = 0,'
        .' home_num_new_received_schedules = 0,'
        ." home_num_new_received_tasks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
