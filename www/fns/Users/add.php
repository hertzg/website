<?php

namespace Users;

function add ($mysqli, $username, $password,
    $email, $admin, $disabled, $expires, $insertApiKey) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Password/hash.php";
    list($password_sha512_hash,
        $password_sha512_key) = \Password\hash($password);

    include_once __DIR__.'/Home/defaultOrder.php';
    $order_home_items = Home\defaultOrder();
    $order_home_items = json_encode($order_home_items);
    $order_home_items = $mysqli->real_escape_string($order_home_items);

    $username = $mysqli->real_escape_string($username);
    $lowercase_username = $mysqli->real_escape_string(strtolower($username));
    $password_sha512_hash = $mysqli->real_escape_string($password_sha512_hash);
    $password_sha512_key = $mysqli->real_escape_string($password_sha512_key);
    $email = $mysqli->real_escape_string($email);
    $admin = $admin ? '1' : '0';
    $disabled = $disabled ? '1' : '0';
    $expires = $expires ? '1' : '0';
    $insert_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

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

    $sql = 'insert into users (username, lowercase_username,'
        .' password_sha512_hash, password_sha512_key,'
        .' encryption_key, encryption_key_iv,'
        .' email, admin, disabled, expires, order_home_items,'
        .' insert_time, theme_color, theme_brightness,'
        .' birthdays_check_day, events_check_day,'
        .' schedules_check_day, task_deadlines_check_day,'
        .' api_keys_order_by, bar_charts_order_by,'
        .' bookmarks_order_by, calculations_order_by, contacts_order_by,'
        .' events_order_by,'
        .' notes_order_by, places_order_by, schedules_order_by,'
        .' tasks_order_by, wallets_order_by,'
        .' insert_api_key_id, insert_api_key_name,'
        .' show_admin, show_bar_charts, show_bookmarks, show_calculations,'
        .' show_calendar, show_contacts, show_files,'
        .' show_notes, show_notifications, show_places,'
        .' show_schedules, show_tasks, show_trash, show_wallets)'
        ." values ('$username', '$lowercase_username',"
        ." '$password_sha512_hash', '$password_sha512_key',"
        ." '$encryption_key', '$encryption_key_iv',"
        ." '$email', $admin, $disabled, $expires, '$order_home_items',"
        ." $insert_time, '$theme_color', '$theme_brightness',"
        ." $birthdays_check_day, $events_check_day,"
        ." $schedules_check_day, $task_deadlines_check_day,"
        ." 'name', 'update_time desc',"
        ." 'update_time desc', 'update_time desc', 'full_name',"
        ." 'event_time desc, start_hour, start_minute, insert_time desc',"
        ." 'update_time desc', 'update_time desc', 'next_time',"
        ." 'update_time desc', 'update_time desc',"
        ." $insert_api_key_id, $insert_api_key_name,"
        ." 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
