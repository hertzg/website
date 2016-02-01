<?php

namespace HomePage;

function newNotifications ($mysqli, $user) {

    $warnings = [];
    $fnsDir = __DIR__.'/..';

    $n = $user->home_num_new_notifications;
    if ($n) {

        include_once "$fnsDir/Users/Notifications/clearNumberNewForHome.php";
        \Users\Notifications\clearNumberNewForHome($mysqli, $user);

        if ($n == 1) $warnings[] = '<b>1</b> new notification.';
        else $warnings[] = "<b>$n</b> new notifications.";

    }

    $items = [];

    $n = $user->home_num_new_received_bookmarks;
    if ($n) {
        if ($n == 1) $items[] = '<b>1</b> new bookmark';
        else $items[] = "<b>$n</b> new bookmarks";
    }

    $n = $user->home_num_new_received_calculations;
    if ($n) {
        if ($n == 1) $items[] = '<b>1</b> new calculation';
        else $items[] = "<b>$n</b> new calculations";
    }

    $n = $user->home_num_new_received_contacts;
    if ($n) {
        if ($n == 1) $items[] = '<b>1</b> new contact';
        else $items[] = "<b>$n</b> new contacts";
    }

    $n = $user->home_num_new_received_files
        + $user->home_num_new_received_folders;
    if ($n) $items[] = $n == 1 ? '<b>1</b> new file' : "<b>$n</b> new files";

    $n = $user->home_num_new_received_notes;
    if ($n) $items[] = $n == 1 ? '<b>1</b> new note' : "<b>$n</b> new notes";

    $n = $user->home_num_new_received_places;
    if ($n) $items[] = $n == 1 ? '<b>1</b> new place' : "<b>$n</b> new places";

    $n = $user->home_num_new_received_schedules;
    if ($n) {
        if ($n == 1) $items[] = '<b>1</b> new schedule';
        else $items[] = "<b>$n</b> new schedules";
    }

    $n = $user->home_num_new_received_tasks;
    if ($n) $items[] = $n == 1 ? '<b>1</b> new task' : "<b>$n</b> new tasks";

    if ($items) {

        include_once "$fnsDir/Users/clearNumNewReceivedItems.php";
        \Users\clearNumNewReceivedItems($mysqli, $user);

        include_once "$fnsDir/join_and.php";
        $warnings[] = 'Received '.join_and($items).'.';

    }

    if ($warnings) {
        include_once "$fnsDir/Page/warnings.php";
        return \Page\warnings($warnings);
    }

}
