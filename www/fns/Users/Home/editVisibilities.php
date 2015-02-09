<?php

namespace Users\Home;

function editVisibilities ($mysqli, $id_users, $bookmarks,
    $new_bookmark, $calendar, $contacts, $new_contact, $files,
    $notes, $new_note, $notifications, $places, $new_place, $schedules,
    $tasks, $new_task, $wallets, $new_wallet, $trash) {

    $bookmarks = $bookmarks ? '1' : '0';
    $new_bookmark = $new_bookmark ? '1' : '0';
    $calendar = $calendar ? '1' : '0';
    $contacts = $contacts ? '1' : '0';
    $new_contact = $new_contact ? '1' : '0';
    $files = $files ? '1' : '0';
    $notes = $notes ? '1' : '0';
    $new_note = $new_note ? '1' : '0';
    $notifications = $notifications ? '1' : '0';
    $places = $places ? '1' : '0';
    $new_place = $new_place ? '1' : '0';
    $schedules = $schedules ? '1' : '0';
    $tasks = $tasks ? '1' : '0';
    $new_task = $new_task ? '1' : '0';
    $wallets = $wallets ? '1' : '0';
    $new_wallet = $new_wallet ? '1' : '0';
    $trash = $trash ? '1' : '0';

    $sql = "update users set show_bookmarks = $bookmarks,"
        ." show_new_bookmark = $new_bookmark, show_calendar = $calendar,"
        ." show_contacts = $contacts, show_new_contact = $new_contact,"
        ." show_files = $files, show_notes = $notes, show_new_note = $new_note,"
        ." show_notifications = $notifications, show_places = $places,"
        ." show_new_place = $new_place,show_schedules = $schedules,"
        ." show_tasks = $tasks, show_new_task = $new_task,"
        ." show_wallets = $wallets, show_new_wallet = $new_wallet,"
        ." show_trash = $trash where id_users = $id_users";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
