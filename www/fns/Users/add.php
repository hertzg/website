<?php

namespace Users;

function add ($mysqli, $username, $password, $email) {

    // TODO separate folder creation from this function

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Password/hash.php";
    list($password_hash, $password_salt) = \Password\hash($password);

    include_once __DIR__.'/Home/defaultOrder.php';
    $order_home_items = Home\defaultOrder();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $username = $mysqli->real_escape_string($username);
    $password_hash = $mysqli->real_escape_string($password_hash);
    $password_salt = $mysqli->real_escape_string($password_salt);
    $email = $mysqli->real_escape_string($email);
    $insert_time = time();

    include_once "$fnsDir/time_today.php";
    $birthdays_check_day = $events_check_day =
        $task_deadlines_check_day = time_today();

    include_once "$fnsDir/time_today.php";
    $schedules_check_day = time_today();

    include_once "$fnsDir/Themes/getDefault.php";
    $theme = \Themes\getDefault();

    $sql = 'insert into users (username, password_hash,'
        .' password_salt, email, order_home_items, insert_time,'
        .' theme, birthdays_check_day, events_check_day,'
        .' schedules_check_day, task_deadlines_check_day,'
        .' show_bookmarks, show_calendar, show_contacts,'
        .' show_files, show_notes, show_notifications, show_places,'
        .' show_schedules, show_tasks, show_trash, show_wallets)'
        ." values ('$username', '$password_hash',"
        ." '$password_salt', '$email', '$order_home_items', $insert_time,"
        ." '$theme', $birthdays_check_day, $events_check_day,"
        ." $schedules_check_day, $task_deadlines_check_day,"
        ." 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id = $mysqli->insert_id;

    include_once __DIR__.'/Directory/path.php';
    $userDir = Directory\path($id);

    mkdir($userDir);
    mkdir("$userDir/files");
    mkdir("$userDir/received-files");
    mkdir("$userDir/received-folder-files");

}
