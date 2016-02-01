<?php

namespace Users;

function clearNumNewReceivedItems ($mysqli, $user) {

    $user->home_num_new_received_bookmarks =
        $user->home_num_new_received_calculations =
        $user->home_num_new_received_contacts =
        $user->home_num_new_received_files =
        $user->home_num_new_received_folders =
        $user->home_num_new_received_notes =
        $user->home_num_new_received_places =
        $user->home_num_new_received_schedules =
        $user->home_num_new_received_tasks = 0;

    $sql = 'update users set home_num_new_received_bookmarks = 0,'
        .' home_num_new_received_calculations = 0,'
        .' home_num_new_received_contacts = 0,'
        .' home_num_new_received_files = 0,'
        .' home_num_new_received_folders = 0,'
        .' home_num_new_received_notes = 0,'
        .' home_num_new_received_places = 0,'
        .' home_num_new_received_schedules = 0,'
        ." home_num_new_received_tasks = 0 where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
