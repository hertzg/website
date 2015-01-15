<?php

namespace HomePage;

function getHomeItems ($mysqli, $user) {

    $fnsDir = __DIR__.'/..';
    $items = [];

    include_once __DIR__.'/renderBookmarks.php';
    renderBookmarks($user, $items);

    if ($user->show_new_bookmark) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-bookmark'] = \Page\imageArrowLink(
            'New Bookmark', '../bookmarks/new/', 'create-bookmark');
    }

    include_once __DIR__.'/renderCalendar.php';
    renderCalendar($user, $mysqli, $items);

    include_once __DIR__.'/renderContacts.php';
    renderContacts($user, $items);

    if ($user->show_new_contact) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-contact'] = \Page\imageArrowLink(
            'New Contact', '../contacts/new/', 'create-contact');
    }

    include_once __DIR__.'/renderFiles.php';
    renderFiles($user, $items);

    include_once __DIR__.'/renderNotes.php';
    renderNotes($user, $items);

    if ($user->show_new_note) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-note'] = \Page\imageArrowLink(
            'New Note', '../notes/new/', 'create-note');
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
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-task'] = \Page\imageArrowLink(
            'New Task', '../tasks/new/', 'create-task');
    }

    include_once __DIR__.'/renderWallets.php';
    renderWallets($user, $items);

    if ($user->show_new_wallet) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items['new-wallet'] = \Page\imageArrowLink(
            'New Wallet', '../wallets/new/', 'create-wallet');
    }

    $sortedItems = [];
    $order_home_items = json_decode($user->order_home_items);
    foreach ($order_home_items as $key) {
        if (array_key_exists($key, $items)) $sortedItems[] = $items[$key];
    }
    return $sortedItems;

}
