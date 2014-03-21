<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/index_messages'],
    $_SESSION['bookmarks/index_messages'],
    $_SESSION['calendar/index_messages'],
    $_SESSION['contacts/index_messages'],
    $_SESSION['customize-home/index_messages'],
    $_SESSION['files/index_messages'],
    $_SESSION['help/index_messages'],
    $_SESSION['notes/index_messages'],
    $_SESSION['notifications/index_messages'],
    $_SESSION['tasks/index_messages']
);

$items = array();

include_once '../fns/SearchForm/emptyContent.php';
$formContent = SearchForm\emptyContent('Search...');

include_once '../lib/mysqli.php';

$num_new_notifications_for_home = $user->num_new_notifications_for_home;
if ($num_new_notifications_for_home) {

    include_once '../fns/Page/warnings.php';
    $notifications = Page\warnings(array(
        "$num_new_notifications_for_home new notifications.",
    ));

    include_once '../fns/Users/clearNumNewNotificationsForHome.php';
    Users\clearNumNewNotificationsForHome($mysqli, $user->idusers);

} else {
    $notifications = '';
}

include_once '../fns/SearchForm/create.php';
$items[] = SearchForm\create('../search/', $formContent);

include_once 'fns/get_home_items.php';
$homeItems = get_home_items($mysqli, $user, $notifications);

$items = array_merge($items, $homeItems);

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
        .Page\imageArrowLink('Customize Home',
            '../customize-home/', 'edit-home')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Help', '../help/', 'help')
        .'<div class="hr"></div>'
        .Page\imageLink('Sign Out', '../submit-signout.php', 'sign-out')
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Home', $content, $base);
