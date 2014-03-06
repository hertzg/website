<?php

$base = '../';

include_once '../fns/require_user.php';
require_user($base);

include_once '../fns/create_panel.php';
include_once '../fns/create_search_form_empty_content.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

unset(
    $_SESSION['account/index_messages'],
    $_SESSION['bookmarks/index_messages'],
    $_SESSION['calendar/index_messages'],
    $_SESSION['contacts/index_messages'],
    $_SESSION['files/index_messages'],
    $_SESSION['help/index_messages'],
    $_SESSION['notes/index_messages'],
    $_SESSION['notifications/index_messages'],
    $_SESSION['tasks/index_messages']
);

$items = array();

$items[] =
    '<form action="../search/" style="height: 48px; position: relative">'
        .create_search_form_empty_content('Search...')
    .'</form>';

include_once 'fns/render_bookmarks.php';
render_bookmarks($user, $items);

include_once 'fns/render_calendar.php';
render_calendar($user, $mysqli, $items);

include_once 'fns/render_contacts.php';
render_contacts($user, $items);

include_once 'fns/render_files.php';
render_files($user, $items);

include_once 'fns/render_notes.php';
render_notes($user, $items);

include_once 'fns/render_notifications.php';
render_notifications($user, $items, $notifications);

include_once 'fns/render_tasks.php';
render_tasks($user, $items);

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('home/index_messages');

include_once '../fns/create_tabs.php';

$page->base = $base;
$page->title = 'Home';
$page->finish(
    create_tabs(array(), 'Home', $pageMessages.$notifications.join(Page::HR, $items))
    .create_panel(
        'Options',
        Page::imageArrowLink('Account', '../account/', 'account')
        .Page::HR
        .Page::imageArrowLink('Help', '../help/', 'help')
        .Page::HR
        .Page::imageLink('Sign Out', '../submit-signout.php', 'sign-out')
    )
);
