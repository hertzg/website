<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$items = array();

include_once '../fns/SearchForm/emptyContent.php';
$formContent = SearchForm\emptyContent('Search...');

include_once '../lib/mysqli.php';

include_once '../fns/SearchForm/create.php';
$items[] = SearchForm\create('../search/', $formContent);

include_once 'fns/get_home_items.php';
$homeItems = get_home_items($mysqli, $user);

$items = array_merge($items, $homeItems);

include_once 'fns/create_new_notifications.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(),
        'Home',
        Page\sessionMessages('home/messages')
        .create_new_notifications($mysqli, $user)
        .join('<div class="hr"></div>', $items)
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
