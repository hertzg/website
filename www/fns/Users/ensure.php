<?php

namespace Users;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Email/column.php";
    include_once "$fnsDir/EncryptionKey/column.php";
    include_once "$fnsDir/EncryptionKey/ivColumn.php";
    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/IPAddress/column.php";
    include_once "$fnsDir/LinkKey/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Theme/Brightness/column.php";
    include_once "$fnsDir/Theme/Color/column.php";
    include_once "$fnsDir/Username/column.php";
    return \Table\ensure($mysqli, 'users', [
        'access_remote_address' => \IPAddress\column(true),
        'access_time' => [
            'type' => 'bigint(21) unsigned',
            'nullable' => true,
        ],
        'anonymous_can_send_bookmark' => ['type' => 'tinyint(3) unsigned'],
        'anonymous_can_send_channel' => ['type' => 'tinyint(3) unsigned'],
        'anonymous_can_send_contact' => ['type' => 'tinyint(3) unsigned'],
        'anonymous_can_send_file' => ['type' => 'tinyint(3) unsigned'],
        'anonymous_can_send_note' => ['type' => 'tinyint(3) unsigned'],
        'anonymous_can_send_place' => ['type' => 'tinyint(3) unsigned'],
        'anonymous_can_send_task' => ['type' => 'tinyint(3) unsigned'],
        'balance_total' => ['type' => 'bigint(20)'],
        'birthdays_check_day' => ['type' => 'bigint(20) unsigned'],
        'email' => \Email\column(),
        'email_expire_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'email_verified' => ['type' => 'tinyint(3) unsigned'],
        'encryption_key' => \EncryptionKey\column(),
        'encryption_key_iv' => \EncryptionKey\ivColumn(),
        'events_check_day' => ['type' => 'bigint(20) unsigned'],
        'full_name' => \FullName\column(),
        'home_num_new_notifications' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_bookmarks' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_contacts' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_files' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_folders' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_notes' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_places' => ['type' => 'bigint(20) unsigned'],
        'home_num_new_received_tasks' => ['type' => 'bigint(20) unsigned'],
        'id_users' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'last_login_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'num_api_keys' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_bookmarks' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_contacts' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_files' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_folders' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_notes' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_places' => ['type' => 'bigint(20) unsigned'],
        'num_archived_received_tasks' => ['type' => 'bigint(20) unsigned'],
        'num_bar_charts' => ['type' => 'bigint(20) unsigned'],
        'num_birthdays_today' => ['type' => 'bigint(20) unsigned'],
        'num_birthdays_tomorrow' => ['type' => 'bigint(20) unsigned'],
        'num_bookmarks' => ['type' => 'bigint(20) unsigned'],
        'num_channels' => ['type' => 'bigint(20) unsigned'],
        'num_connections' => ['type' => 'bigint(20) unsigned'],
        'num_contacts' => ['type' => 'bigint(20) unsigned'],
        'num_deleted_items' => ['type' => 'bigint(20) unsigned'],
        'num_events' => ['type' => 'bigint(20) unsigned'],
        'num_events_today' => ['type' => 'bigint(20) unsigned'],
        'num_events_tomorrow' => ['type' => 'bigint(20) unsigned'],
        'num_folders' => ['type' => 'bigint(20) unsigned'],
        'num_logins' => ['type' => 'bigint(20) unsigned'],
        'num_new_notifications' => ['type' => 'bigint(20) unsigned'],
        'num_notes' => ['type' => 'bigint(20) unsigned'],
        'num_notifications' => ['type' => 'bigint(20) unsigned'],
        'num_password_protected_notes' => ['type' => 'bigint(20) unsigned'],
        'num_places' => ['type' => 'bigint(20) unsigned'],
        'num_received_bookmarks' => ['type' => 'bigint(20) unsigned'],
        'num_received_contacts' => ['type' => 'bigint(20) unsigned'],
        'num_received_files' => ['type' => 'bigint(20) unsigned'],
        'num_received_folders' => ['type' => 'bigint(20) unsigned'],
        'num_received_notes' => ['type' => 'bigint(20) unsigned'],
        'num_received_places' => ['type' => 'bigint(20) unsigned'],
        'num_received_tasks' => ['type' => 'bigint(20) unsigned'],
        'num_schedules' => ['type' => 'bigint(20) unsigned'],
        'num_schedules_today' => ['type' => 'bigint(20) unsigned'],
        'num_schedules_tomorrow' => ['type' => 'bigint(20) unsigned'],
        'num_subscribed_channels' => ['type' => 'bigint(20) unsigned'],
        'num_task_deadlines_today' => ['type' => 'bigint(20) unsigned'],
        'num_task_deadlines_tomorrow' => ['type' => 'bigint(20) unsigned'],
        'num_tasks' => ['type' => 'bigint(20) unsigned'],
        'num_tokens' => ['type' => 'bigint(20) unsigned'],
        'num_wallets' => ['type' => 'bigint(20) unsigned'],
        'order_home_items' => [
            'type' => 'text',
            'nullable' => true,
            'characterSet' => 'ascii',
            'collation' => 'ascii_general_ci',
        ],
        'password_hash' => [
            'type' => 'binary(16)',
            'nullable' => true,
        ],
        'password_salt' => [
            'type' => 'varbinary(32)',
            'nullable' => true,
        ],
        'password_sha512_hash' => [
            'type' => 'binary(64)',
            'nullable' => true,
        ],
        'password_sha512_key' => [
            'type' => 'binary(64)',
            'nullable' => true,
        ],
        'reset_password_key' => \LinkKey\column(true),
        'reset_password_key_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'reset_password_return' => [
            'type' => 'varchar(2048)',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'schedules_check_day' => ['type' => 'bigint(20) unsigned'],
        'show_bar_charts' => ['type' => 'tinyint(3) unsigned'],
        'show_bookmarks' => ['type' => 'tinyint(3) unsigned'],
        'show_calendar' => ['type' => 'tinyint(3) unsigned'],
        'show_contacts' => ['type' => 'tinyint(3) unsigned'],
        'show_files' => ['type' => 'tinyint(3) unsigned'],
        'show_new_bar_chart' => ['type' => 'tinyint(3) unsigned'],
        'show_new_bookmark' => ['type' => 'tinyint(3) unsigned'],
        'show_new_contact' => ['type' => 'tinyint(3) unsigned'],
        'show_new_event' => ['type' => 'tinyint(3) unsigned'],
        'show_new_note' => ['type' => 'tinyint(3) unsigned'],
        'show_new_place' => ['type' => 'tinyint(3) unsigned'],
        'show_new_task' => ['type' => 'tinyint(3) unsigned'],
        'show_new_wallet' => ['type' => 'tinyint(3) unsigned'],
        'show_new_transaction' => ['type' => 'tinyint(3) unsigned'],
        'show_notes' => ['type' => 'tinyint(3) unsigned'],
        'show_notifications' => ['type' => 'tinyint(3) unsigned'],
        'show_places' => ['type' => 'tinyint(3) unsigned'],
        'show_schedules' => ['type' => 'tinyint(3) unsigned'],
        'show_new_schedule' => ['type' => 'tinyint(3) unsigned'],
        'show_tasks' => ['type' => 'tinyint(3) unsigned'],
        'show_transfer_amount' => ['type' => 'tinyint(3) unsigned'],
        'show_trash' => ['type' => 'tinyint(3) unsigned'],
        'show_upload_files' => ['type' => 'tinyint(3) unsigned'],
        'show_wallets' => ['type' => 'tinyint(3) unsigned'],
        'storage_used' => ['type' => 'bigint(20) unsigned'],
        'task_deadlines_check_day' => ['type' => 'bigint(20) unsigned'],
        'theme_brightness' => \Theme\Brightness\column(),
        'theme_color' => \Theme\Color\column(),
        'timezone' => ['type' => 'int(11)'],
        'username' => \Username\column(),
        'verify_email_key' => \LinkKey\column(true),
        'verify_email_key_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
    ]);

}
