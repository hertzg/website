<?php

function get_home_items ($user, &$notifications) {

    $items = array();

    include_once __DIR__.'/render_bookmarks.php';
    render_bookmarks($user, $items);

    include_once __DIR__.'/render_calendar.php';
    include_once '../lib/mysqli.php';
    render_calendar($user, $mysqli, $items);

    include_once __DIR__.'/render_contacts.php';
    render_contacts($user, $items);

    include_once __DIR__.'/render_files.php';
    render_files($user, $items);

    include_once __DIR__.'/render_notes.php';
    render_notes($user, $items);

    include_once __DIR__.'/render_notifications.php';
    render_notifications($user, $items, $notifications);

    include_once __DIR__.'/render_tasks.php';
    render_tasks($user, $items);

    $sortedItems = array();
    $order_home_items = json_decode($user->order_home_items);
    foreach ($order_home_items as $key) {
        if (array_key_exists($key, $items)) {
            $sortedItems[] = $items[$key];
        }
    }
    return $sortedItems;

}
