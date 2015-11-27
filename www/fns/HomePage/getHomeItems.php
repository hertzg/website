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

    $html = '<div class="thumbnails">';
    foreach ($sortedItems as $i => $item) {

        $additionalClass = '';
        if ($i % 3 === 1) $additionalClass .= ' wide_of_three';
        if ($i % 6 === 1 || $i % 6 === 4) $additionalClass .= ' narrow_of_six';

        $html .= "<div class=\"thumbnails-item$additionalClass\">$item</div>";
        if ($i % 3 === 2) $html .= '<span class="hr thumbnails-br n3"></span>';
        if ($i % 4 === 3) $html .= '<span class="hr thumbnails-br n4"></span>';
        if ($i % 5 === 4) $html .= '<span class="hr thumbnails-br n5"></span>';
        if ($i % 6 === 5) $html .= '<span class="hr thumbnails-br n6"></span>';
        if ($i % 7 === 6) $html .= '<span class="hr thumbnails-br n7"></span>';

    }
    $html .= '</div>';
    return $html;

}
