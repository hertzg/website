<?php

namespace HomePage;

function getHomeItems ($mysqli, $user, &$scripts) {

    $fnsDir = __DIR__.'/..';
    $items = [];

    include_once __DIR__.'/renderBarCharts.php';
    renderBarCharts($user, $items);

    include_once __DIR__.'/renderBookmarks.php';
    renderBookmarks($user, $items);

    include_once __DIR__.'/renderCalendar.php';
    renderCalendar($user, $mysqli, $items, $scripts);

    include_once __DIR__.'/renderContacts.php';
    renderContacts($user, $items);

    include_once __DIR__.'/renderFiles.php';
    renderFiles($user, $items);

    include_once __DIR__.'/renderNotes.php';
    renderNotes($user, $items);

    include_once __DIR__.'/renderNotifications.php';
    renderNotifications($user, $items);

    include_once __DIR__.'/renderPlaces.php';
    renderPlaces($user, $items);

    include_once __DIR__.'/renderSchedules.php';
    renderSchedules($user, $mysqli, $items);

    include_once __DIR__.'/renderTasks.php';
    renderTasks($user, $items);

    include_once __DIR__.'/renderTrash.php';
    renderTrash($user, $items);

    include_once __DIR__.'/renderWallets.php';
    renderWallets($user, $items);

    $sortedItems = [];
    $order_home_items = json_decode($user->order_home_items);
    foreach ($order_home_items as $key) {
        if (array_key_exists($key, $items)) $sortedItems[] = $items[$key];
    }
    return join('<div class="hr"></div>', $sortedItems);

}
