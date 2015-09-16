<?php

namespace Users;

function add ($mysqli, $username, $password, $email) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Password/hash.php";
    list($password_sha512_hash,
        $password_sha512_key) = \Password\hash($password);

    include_once __DIR__.'/Home/defaultOrder.php';
    $order_home_items = Home\defaultOrder();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $username = $mysqli->real_escape_string($username);
    $password_sha512_hash = $mysqli->real_escape_string($password_sha512_hash);
    $password_sha512_key = $mysqli->real_escape_string($password_sha512_key);
    $email = $mysqli->real_escape_string($email);
    $insert_time = time();

    include_once "$fnsDir/EncryptionKey/random.php";
    \EncryptionKey\random($password, $random_key,
        $encryption_key, $encryption_key_iv);
    $encryption_key = $mysqli->real_escape_string($encryption_key);

    include_once "$fnsDir/time_today.php";
    $birthdays_check_day = $events_check_day =
        $task_deadlines_check_day = $schedules_check_day = time_today();

    include_once "$fnsDir/Theme/Color/getDefault.php";
    $theme_color = \Theme\Color\getDefault();

    include_once "$fnsDir/Theme/Brightness/getDefault.php";
    $theme_brightness = \Theme\Brightness\getDefault();

    $sql = 'insert into users (username, password_sha512_hash,'
        .' password_sha512_key, encryption_key, encryption_key_iv,'
        .' email, order_home_items, insert_time, theme_color,'
        .' theme_brightness, birthdays_check_day, events_check_day,'
        .' schedules_check_day, task_deadlines_check_day,'
        .' bar_charts_order_by, bookmarks_order_by,'
        .' contacts_order_by, notes_order_by, places_order_by,'
        .' schedules_order_by, tasks_order_by,'
        .' show_bar_charts, show_bookmarks, show_calendar, show_contacts,'
        .' show_files, show_notes, show_notifications, show_places,'
        .' show_schedules, show_tasks, show_trash, show_wallets)'
        ." values ('$username', '$password_sha512_hash',"
        ." '$password_sha512_key', '$encryption_key', '$encryption_key_iv',"
        ." '$email', '$order_home_items', $insert_time, '$theme_color',"
        ." '$theme_brightness', $birthdays_check_day, $events_check_day,"
        ." $schedules_check_day, $task_deadlines_check_day,"
        ." 'update_time desc', 'update_time desc',"
        ." 'full_name', 'update_time desc', 'update_time desc',"
        ." 'update_time desc', 'update_time desc',"
        ." 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
