<?php

namespace Users;

function restoreDefaultVisibilities ($mysqli, $id_users) {
    $sql = 'update users set'
        .' show_bookmarks = 1, show_new_bookmark = 0,'
        .' show_calendar = 1, show_contacts = 1, show_new_contact = 0,'
        .' show_files = 1, show_notes = 1, show_new_note = 0,'
        .' show_notifications = 1, show_schedules = 1, show_tasks = 1,'
        ." show_new_task = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
