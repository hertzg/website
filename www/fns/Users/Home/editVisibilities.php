<?php

namespace Users\Home;

function editVisibilities ($mysqli, $id_users, $bar_charts, $new_bar_chart,
    $bookmarks, $new_bookmark, $calendar, $new_event, $contacts, $new_contact,
    $files, $upload_files, $notes, $new_note, $notifications, $places,
    $new_place, $schedules, $tasks, $new_task, $wallets, $new_wallet,
    $new_transaction, $transfer_amount, $trash) {

    $bar_charts = $bar_charts ? '1' : '0';
    $new_bar_chart = $new_bar_chart ? '1' : '0';
    $bookmarks = $bookmarks ? '1' : '0';
    $new_bookmark = $new_bookmark ? '1' : '0';
    $calendar = $calendar ? '1' : '0';
    $new_event = $new_event ? '1' : '0';
    $contacts = $contacts ? '1' : '0';
    $new_contact = $new_contact ? '1' : '0';
    $files = $files ? '1' : '0';
    $upload_files = $upload_files ? '1' : '0';
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
    $new_transaction = $new_transaction ? '1' : '0';
    $transfer_amount = $transfer_amount ? '1' : '0';
    $trash = $trash ? '1' : '0';

    $sql = "update users set show_bar_charts = $bar_charts,"
        ." show_new_bar_chart = $new_bar_chart, show_bookmarks = $bookmarks,"
        ." show_new_bookmark = $new_bookmark, show_calendar = $calendar,"
        ." show_new_event = $new_event, show_contacts = $contacts,"
        ." show_new_contact = $new_contact, show_files = $files,"
        ." show_upload_files = $upload_files, show_notes = $notes,"
        ." show_new_note = $new_note, show_notifications = $notifications,"
        ." show_places = $places, show_new_place = $new_place,"
        ." show_schedules = $schedules, show_tasks = $tasks,"
        ." show_new_task = $new_task, show_wallets = $wallets,"
        ." show_new_wallet = $new_wallet,"
        ." show_new_transaction = $new_transaction,"
        ." show_transfer_amount = $transfer_amount,"
        ." show_trash = $trash where id_users = $id_users";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
