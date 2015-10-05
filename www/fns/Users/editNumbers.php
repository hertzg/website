<?php

namespace Users;

function editNumbers ($mysqli, $id, $num_api_keys,
    $num_archived_received_bookmarks, $num_archived_received_contacts,
    $num_archived_received_files, $num_archived_received_folders,
    $num_archived_received_notes, $num_archived_received_places,
    $num_archived_received_tasks, $num_bar_charts, $num_bookmarks,
    $num_channels, $num_connections, $num_contacts, $num_deleted_items,
    $num_events, $num_files, $num_folders, $num_notes, $num_notifications,
    $num_password_protected_notes, $num_places, $num_received_bookmarks,
    $num_received_contacts, $num_received_files, $num_received_folders,
    $num_received_notes, $num_received_places, $num_received_tasks,
    $num_schedules, $num_subscribed_channels,
    $num_tasks, $num_tokens, $num_wallets) {

    $sql = "update users set num_api_keys = $num_api_keys,"
        ." num_archived_received_bookmarks = $num_archived_received_bookmarks,"
        ." num_archived_received_contacts = $num_archived_received_contacts,"
        ." num_archived_received_files = $num_archived_received_files,"
        ." num_archived_received_folders = $num_archived_received_folders,"
        ." num_archived_received_notes = $num_archived_received_notes,"
        ." num_archived_received_places = $num_archived_received_places,"
        ." num_archived_received_tasks = $num_archived_received_tasks,"
        ." num_bar_charts = $num_bar_charts, num_bookmarks = $num_bookmarks,"
        ." num_channels = $num_channels, num_connections = $num_connections,"
        ." num_contacts = $num_contacts,"
        ." num_deleted_items = $num_deleted_items, num_events = $num_events,"
        ." num_files = $num_files, num_folders = $num_folders,"
        ." num_notes = $num_notes, num_notifications = $num_notifications,"
        ." num_password_protected_notes = $num_password_protected_notes,"
        ." num_places = $num_places,"
        ." num_received_bookmarks = $num_received_bookmarks,"
        ." num_received_contacts = $num_received_contacts,"
        ." num_received_files = $num_received_files,"
        ." num_received_folders = $num_received_folders,"
        ." num_received_notes = $num_received_notes,"
        ." num_received_places = $num_received_places,"
        ." num_received_tasks = $num_received_tasks,"
        ." num_schedules = $num_schedules,"
        ." num_subscribed_channels = $num_subscribed_channels,"
        ." num_tasks = $num_tasks, num_tokens = $num_tokens,"
        ." num_wallets = $num_wallets where id_users = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
