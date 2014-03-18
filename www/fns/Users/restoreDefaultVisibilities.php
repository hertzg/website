<?php

namespace Users;

function restoreDefaultVisibilities ($mysqli, $idusers) {
    $mysqli->query(
        'update users set'
        .' show_bookmarks = 1, show_new_bookmark = 0,'
        .' show_calendar = 1, show_contacts = 1, show_new_contact = 0,'
        .' show_files = 1, show_notes = 1, show_new_note = 0,'
        .' show_notifications = 1, show_tasks = 1, show_new_task = 0'
        ." where idusers = $idusers"
    ) || trigger_error($mysqli->error);
}
