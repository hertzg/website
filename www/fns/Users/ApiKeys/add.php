<?php

namespace Users\ApiKeys;

function add ($mysqli, $id_users, $name, $expire_time,
    $can_read_bar_charts, $can_read_bookmarks, $can_read_calculations,
    $can_read_channels, $can_read_contacts, $can_read_events, $can_read_files,
    $can_read_notes, $can_read_notifications, $can_read_places,
    $can_read_schedules, $can_read_tasks, $can_read_wallets,
    $can_write_bar_charts, $can_write_bookmarks, $can_write_calculations,
    $can_write_channels, $can_write_contacts, $can_write_events,
    $can_write_files, $can_write_notes, $can_write_notifications,
    $can_write_places, $can_write_schedules,
    $can_write_tasks, $can_write_wallets) {

    include_once __DIR__.'/../../ApiKeys/add.php';
    $id = \ApiKeys\add($mysqli, $id_users, $name, $expire_time,
        $can_read_bar_charts, $can_read_bookmarks, $can_read_calculations,
        $can_read_channels, $can_read_contacts, $can_read_events,
        $can_read_files, $can_read_notes, $can_read_notifications,
        $can_read_places, $can_read_schedules, $can_read_tasks,
        $can_read_wallets, $can_write_bar_charts,
        $can_write_bookmarks, $can_write_calculations,
        $can_write_channels, $can_write_contacts,
        $can_write_events, $can_write_files, $can_write_notes,
        $can_write_notifications, $can_write_places, $can_write_schedules,
        $can_write_tasks, $can_write_wallets);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
