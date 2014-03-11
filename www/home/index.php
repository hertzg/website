<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

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

include_once '../fns/SearchForm/emptyContent.php';
$formContent = SearchForm\emptyContent('Search...');

include_once '../fns/SearchForm/create.php';
$items[] = SearchForm\create('../search/', $formContent);

include_once 'fns/render_bookmarks.php';
render_bookmarks($user, $items);

include_once 'fns/render_calendar.php';
include_once '../lib/mysqli.php';
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

include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(),
        'Home',
        Page\sessionMessages('home/index_messages')
        .$notifications.join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Account', '../account/', 'account')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Help', '../help/', 'help')
        .'<div class="hr"></div>'
        .Page\imageLink('Sign Out', '../submit-signout.php', 'sign-out')
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Home', $content, $base);
