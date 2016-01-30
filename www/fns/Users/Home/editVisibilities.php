<?php

namespace Users\Home;

function editVisibilities ($mysqli, $user, $admin, $bar_charts,
    $new_bar_chart, $bookmarks, $new_bookmark, $calculations,
    $new_calculation, $calendar, $new_event, $contacts, $new_contact,
    $files, $upload_files, $notes, $new_note, $notifications,
    $post_notification, $places, $new_place, $schedules,
    $new_schedule, $tasks, $new_task, $wallets, $new_wallet,
    $new_transaction, $transfer_amount, $trash, &$changed) {

    if ((bool)$user->show_admin === $admin &&
        (bool)$user->show_bar_charts === $bar_charts &&
        (bool)$user->show_new_bar_chart === $new_bar_chart &&
        (bool)$user->show_bookmarks === $bookmarks &&
        (bool)$user->show_new_bookmark === $new_bookmark &&
        (bool)$user->show_calculations === $calculations &&
        (bool)$user->show_new_calculation === $new_calculation &&
        (bool)$user->show_calendar === $calendar &&
        (bool)$user->show_new_event === $new_event &&
        (bool)$user->show_contacts === $contacts &&
        (bool)$user->show_new_contact === $new_contact &&
        (bool)$user->show_files === $files &&
        (bool)$user->show_upload_files === $upload_files &&
        (bool)$user->show_notes === $notes &&
        (bool)$user->show_new_note === $new_note &&
        (bool)$user->show_notifications === $notifications &&
        (bool)$user->show_post_notification === $post_notification &&
        (bool)$user->show_places === $places &&
        (bool)$user->show_new_place === $new_place &&
        (bool)$user->show_schedules === $schedules &&
        (bool)$user->show_new_schedule === $new_schedule &&
        (bool)$user->show_tasks === $tasks &&
        (bool)$user->show_new_task === $new_task &&
        (bool)$user->show_wallets === $wallets &&
        (bool)$user->show_new_wallet === $new_wallet &&
        (bool)$user->show_new_transaction === $new_transaction &&
        (bool)$user->show_transfer_amount === $transfer_amount &&
        (bool)$user->show_trash === $trash) return;

    $changed = true;
    $admin = $admin ? '1' : '0';
    $bar_charts = $bar_charts ? '1' : '0';
    $new_bar_chart = $new_bar_chart ? '1' : '0';
    $bookmarks = $bookmarks ? '1' : '0';
    $new_bookmark = $new_bookmark ? '1' : '0';
    $calculations = $calculations ? '1' : '0';
    $new_calculation = $new_calculation ? '1' : '0';
    $calendar = $calendar ? '1' : '0';
    $new_event = $new_event ? '1' : '0';
    $contacts = $contacts ? '1' : '0';
    $new_contact = $new_contact ? '1' : '0';
    $files = $files ? '1' : '0';
    $upload_files = $upload_files ? '1' : '0';
    $notes = $notes ? '1' : '0';
    $new_note = $new_note ? '1' : '0';
    $notifications = $notifications ? '1' : '0';
    $post_notification = $post_notification ? '1' : '0';
    $places = $places ? '1' : '0';
    $new_place = $new_place ? '1' : '0';
    $schedules = $schedules ? '1' : '0';
    $new_schedule = $new_schedule ? '1' : '0';
    $tasks = $tasks ? '1' : '0';
    $new_task = $new_task ? '1' : '0';
    $wallets = $wallets ? '1' : '0';
    $new_wallet = $new_wallet ? '1' : '0';
    $new_transaction = $new_transaction ? '1' : '0';
    $transfer_amount = $transfer_amount ? '1' : '0';
    $trash = $trash ? '1' : '0';

    $sql = "update users set show_admin = $admin,"
        ." show_bar_charts = $bar_charts,"
        ." show_new_bar_chart = $new_bar_chart, show_bookmarks = $bookmarks,"
        ." show_new_bookmark = $new_bookmark,"
        ." show_calculations = $calculations,"
        ." show_new_calculation = $new_calculation, show_calendar = $calendar,"
        ." show_new_event = $new_event, show_contacts = $contacts,"
        ." show_new_contact = $new_contact, show_files = $files,"
        ." show_upload_files = $upload_files, show_notes = $notes,"
        ." show_new_note = $new_note, show_notifications = $notifications,"
        ." show_post_notification = $post_notification,"
        ." show_places = $places, show_new_place = $new_place,"
        ." show_schedules = $schedules, show_new_schedule = $new_schedule,"
        ." show_tasks = $tasks, show_new_task = $new_task,"
        ." show_wallets = $wallets, show_new_wallet = $new_wallet,"
        ." show_new_transaction = $new_transaction,"
        ." show_transfer_amount = $transfer_amount,"
        ." show_trash = $trash where id_users = $user->id_users";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
