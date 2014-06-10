<?php

function get_home_items ($mysqli, $user) {

    $items = [];

    include_once __DIR__.'/render_bookmarks.php';
    render_bookmarks($user, $items);

    if ($user->show_new_bookmark) {
        $title = 'New Bookmark';
        $href = '../bookmarks/new/';
        $icon = 'create-bookmark';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items['new-bookmark'] = Page\imageArrowLink($title, $href, $icon);
    }

    include_once __DIR__.'/render_calendar.php';
    render_calendar($user, $mysqli, $items);

    include_once __DIR__.'/render_contacts.php';
    render_contacts($user, $items);

    if ($user->show_new_contact) {
        $title = 'New Contact';
        $href = '../contacts/new/';
        $icon = 'create-contact';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items['new-contact'] = Page\imageArrowLink($title, $href, $icon);
    }

    include_once __DIR__.'/render_files.php';
    render_files($user, $items);

    include_once __DIR__.'/render_notes.php';
    render_notes($user, $items);

    if ($user->show_new_note) {
        $title = 'New Note';
        $href = '../notes/new/';
        $icon = 'create-note';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items['new-note'] = Page\imageArrowLink($title, $href, $icon);
    }

    include_once __DIR__.'/render_notifications.php';
    render_notifications($user, $items);

    include_once __DIR__.'/render_schedules.php';
    render_schedules($user, $mysqli, $items);

    include_once __DIR__.'/render_tasks.php';
    render_tasks($user, $items);

    include_once __DIR__.'/render_trash.php';
    render_trash($user, $items);

    if ($user->show_new_task) {
        $title = 'New Task';
        $href = '../tasks/new/';
        $icon = 'create-task';
        include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
        $items['new-task'] = Page\imageArrowLink($title, $href, $icon);
    }

    $sortedItems = [];
    $order_home_items = json_decode($user->order_home_items);
    foreach ($order_home_items as $key) {
        if (array_key_exists($key, $items)) {
            $sortedItems[] = $items[$key];
        }
    }
    return $sortedItems;

}
