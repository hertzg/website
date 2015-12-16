<?php

namespace Users;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/IPAddress/column.php";
    $ipAddressColumn = \IPAddress\column(true);

    $nullable_unsigned_bigint = [
        'type' => 'bigint(20) unsigned',
        'nullable' => true,
    ];
    $unsigned_bigint = ['type' => 'bigint(20) unsigned'];
    $unsigned_tinyint = ['type' => 'tinyint(3) unsigned'];
    $order_by_column = [
        'type' => 'varchar(100)',
        'characterSet' => 'ascii',
        'collation' => 'ascii_general_ci',
    ];

    include_once "$fnsDir/ApiKeyName/column.php";
    include_once "$fnsDir/Email/column.php";
    include_once "$fnsDir/EncryptionKey/column.php";
    include_once "$fnsDir/EncryptionKey/ivColumn.php";
    include_once "$fnsDir/FullName/column.php";
    include_once "$fnsDir/LinkKey/column.php";
    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Theme/Brightness/column.php";
    include_once "$fnsDir/Theme/Color/column.php";
    include_once "$fnsDir/Username/column.php";
    include_once "$fnsDir/Username/lowercaseColumn.php";
    return \Table\ensure($mysqli, 'users', [
        'access_remote_address' => $ipAddressColumn,
        'access_time' => $nullable_unsigned_bigint,
        'anonymous_can_send_bookmark' => $unsigned_tinyint,
        'anonymous_can_send_calculation' => $unsigned_tinyint,
        'anonymous_can_send_channel' => $unsigned_tinyint,
        'anonymous_can_send_contact' => $unsigned_tinyint,
        'anonymous_can_send_file' => $unsigned_tinyint,
        'anonymous_can_send_note' => $unsigned_tinyint,
        'anonymous_can_send_place' => $unsigned_tinyint,
        'anonymous_can_send_schedule' => $unsigned_tinyint,
        'anonymous_can_send_task' => $unsigned_tinyint,
        'api_keys_order_by' => $order_by_column,
        'balance_total' => ['type' => 'bigint(20)'],
        'bar_charts_order_by' => $order_by_column,
        'bookmarks_order_by' => $order_by_column,
        'birthdays_check_day' => $unsigned_bigint,
        'calculations_order_by' => $order_by_column,
        'contacts_order_by' => $order_by_column,
        'disabled' => $unsigned_tinyint,
        'email' => \Email\column(),
        'email_expire_time' => $nullable_unsigned_bigint,
        'email_verified' => $unsigned_tinyint,
        'encryption_key' => \EncryptionKey\column(),
        'encryption_key_iv' => \EncryptionKey\ivColumn(),
        'events_check_day' => $unsigned_bigint,
        'events_order_by' => $order_by_column,
        'expires' => $unsigned_tinyint,
        'full_name' => \FullName\column(),
        'home_num_new_notifications' => $unsigned_bigint,
        'home_num_new_received_bookmarks' => $unsigned_bigint,
        'home_num_new_received_calculations' => $unsigned_bigint,
        'home_num_new_received_contacts' => $unsigned_bigint,
        'home_num_new_received_files' => $unsigned_bigint,
        'home_num_new_received_folders' => $unsigned_bigint,
        'home_num_new_received_notes' => $unsigned_bigint,
        'home_num_new_received_places' => $unsigned_bigint,
        'home_num_new_received_schedules' => $unsigned_bigint,
        'home_num_new_received_tasks' => $unsigned_bigint,
        'id_users' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'insert_api_key_id' => $nullable_unsigned_bigint,
        'insert_api_key_name' => \ApiKeyName\column(true),
        'insert_time' => $unsigned_bigint,
        'last_signin_remote_address' => $ipAddressColumn,
        'last_signin_time' => $nullable_unsigned_bigint,
        'lowercase_username' => \Username\lowercaseColumn(),
        'notes_order_by' => $order_by_column,
        'num_api_keys' => $unsigned_bigint,
        'num_archived_received_bookmarks' => $unsigned_bigint,
        'num_archived_received_calculations' => $unsigned_bigint,
        'num_archived_received_contacts' => $unsigned_bigint,
        'num_archived_received_files' => $unsigned_bigint,
        'num_archived_received_folders' => $unsigned_bigint,
        'num_archived_received_notes' => $unsigned_bigint,
        'num_archived_received_places' => $unsigned_bigint,
        'num_archived_received_schedules' => $unsigned_bigint,
        'num_archived_received_tasks' => $unsigned_bigint,
        'num_bar_charts' => $unsigned_bigint,
        'num_birthdays_today' => $unsigned_bigint,
        'num_birthdays_tomorrow' => $unsigned_bigint,
        'num_bookmarks' => $unsigned_bigint,
        'num_calculations' => $unsigned_bigint,
        'num_channels' => $unsigned_bigint,
        'num_connections' => $unsigned_bigint,
        'num_contacts' => $unsigned_bigint,
        'num_deleted_items' => $unsigned_bigint,
        'num_events' => $unsigned_bigint,
        'num_events_today' => $unsigned_bigint,
        'num_events_tomorrow' => $unsigned_bigint,
        'num_files' => $unsigned_bigint,
        'num_folders' => $unsigned_bigint,
        'num_new_notifications' => $unsigned_bigint,
        'num_notes' => $unsigned_bigint,
        'num_notifications' => $unsigned_bigint,
        'num_password_protected_notes' => $unsigned_bigint,
        'num_places' => $unsigned_bigint,
        'num_received_bookmarks' => $unsigned_bigint,
        'num_received_calculations' => $unsigned_bigint,
        'num_received_contacts' => $unsigned_bigint,
        'num_received_files' => $unsigned_bigint,
        'num_received_folders' => $unsigned_bigint,
        'num_received_notes' => $unsigned_bigint,
        'num_received_places' => $unsigned_bigint,
        'num_received_schedules' => $unsigned_bigint,
        'num_received_tasks' => $unsigned_bigint,
        'num_schedules' => $unsigned_bigint,
        'num_schedules_today' => $unsigned_bigint,
        'num_schedules_tomorrow' => $unsigned_bigint,
        'num_signins' => $unsigned_bigint,
        'num_subscribed_channels' => $unsigned_bigint,
        'num_task_deadlines_today' => $unsigned_bigint,
        'num_task_deadlines_tomorrow' => $unsigned_bigint,
        'num_tasks' => $unsigned_bigint,
        'num_tokens' => $unsigned_bigint,
        'num_wallets' => $unsigned_bigint,
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
        'places_order_by' => $order_by_column,
        'reset_password_key' => \LinkKey\column(true),
        'reset_password_key_time' => $nullable_unsigned_bigint,
        'reset_password_return' => [
            'type' => 'varchar(2048)',
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'schedules_check_day' => $unsigned_bigint,
        'schedules_order_by' => $order_by_column,
        'show_bar_charts' => $unsigned_tinyint,
        'show_bookmarks' => $unsigned_tinyint,
        'show_calculations' => $unsigned_tinyint,
        'show_calendar' => $unsigned_tinyint,
        'show_contacts' => $unsigned_tinyint,
        'show_files' => $unsigned_tinyint,
        'show_new_bar_chart' => $unsigned_tinyint,
        'show_new_bookmark' => $unsigned_tinyint,
        'show_new_calculation' => $unsigned_tinyint,
        'show_new_contact' => $unsigned_tinyint,
        'show_new_event' => $unsigned_tinyint,
        'show_new_note' => $unsigned_tinyint,
        'show_new_place' => $unsigned_tinyint,
        'show_new_task' => $unsigned_tinyint,
        'show_new_wallet' => $unsigned_tinyint,
        'show_new_transaction' => $unsigned_tinyint,
        'show_notes' => $unsigned_tinyint,
        'show_notifications' => $unsigned_tinyint,
        'show_places' => $unsigned_tinyint,
        'show_post_notification' => $unsigned_tinyint,
        'show_schedules' => $unsigned_tinyint,
        'show_new_schedule' => $unsigned_tinyint,
        'show_tasks' => $unsigned_tinyint,
        'show_transfer_amount' => $unsigned_tinyint,
        'show_trash' => $unsigned_tinyint,
        'show_upload_files' => $unsigned_tinyint,
        'show_wallets' => $unsigned_tinyint,
        'storage_used' => $unsigned_bigint,
        'task_deadlines_check_day' => $unsigned_bigint,
        'tasks_order_by' => $order_by_column,
        'theme_brightness' => \Theme\Brightness\column(),
        'theme_color' => \Theme\Color\column(),
        'timezone' => ['type' => 'int(11)'],
        'username' => \Username\column(),
        'verify_email_key' => \LinkKey\column(true),
        'verify_email_key_time' => $nullable_unsigned_bigint,
        'wallets_order_by' => $order_by_column,
    ]);

}
