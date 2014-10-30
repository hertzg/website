<?php

namespace HomePage;

function getHomeItems ($mysqli, $user) {

    $fnsDir = __DIR__.'/..';
    $items = [];

    include_once __DIR__.'/renderBookmarks.php';
    renderBookmarks($user, $items);

    if ($user->show_new_bookmark) {
        $title = 'New Bookmark';
        $href = '../bookmarks/new/';
        $icon = 'create-bookmark';
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-bookmark'] = \Page\imageArrowLink($title, $href, $icon);
    }

    include_once __DIR__.'/renderCalendar.php';
    renderCalendar($user, $mysqli, $items);

    include_once __DIR__.'/renderContacts.php';
    renderContacts($user, $items);

    if ($user->show_new_contact) {
        $title = 'New Contact';
        $href = '../contacts/new/';
        $icon = 'create-contact';
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-contact'] = \Page\imageArrowLink($title, $href, $icon);
    }

    include_once __DIR__.'/renderFiles.php';
    renderFiles($user, $items);

    include_once __DIR__.'/renderNotes.php';
    renderNotes($user, $items);

    if ($user->show_new_note) {
        $title = 'New Note';
        $href = '../notes/new/';
        $icon = 'create-note';
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-note'] = \Page\imageArrowLink($title, $href, $icon);
    }

    include_once __DIR__.'/renderNotifications.php';
    renderNotifications($user, $items);

    include_once __DIR__.'/renderSchedules.php';
    renderSchedules($user, $mysqli, $items);

    include_once __DIR__.'/renderTasks.php';
    renderTasks($user, $items);

    include_once __DIR__.'/renderTrash.php';
    renderTrash($user, $items);

    if ($user->show_new_task) {
        $title = 'New Task';
        $href = '../tasks/new/';
        $icon = 'create-task';
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-task'] = \Page\imageArrowLink($title, $href, $icon);
    }

    $sortedItems = [];
    $order_home_items = json_decode($user->order_home_items);
    foreach ($order_home_items as $key) {
        if (array_key_exists($key, $items)) $sortedItems[] = $items[$key];
    }
    return $sortedItems;

}
