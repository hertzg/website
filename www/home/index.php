<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$items = [];

include_once '../fns/SearchForm/emptyContent.php';
$formContent = SearchForm\emptyContent('Search...');

include_once '../lib/mysqli.php';

include_once '../fns/SearchForm/create.php';
$items[] = SearchForm\create('../search/', $formContent);

include_once 'fns/get_home_items.php';
$homeItems = get_home_items($mysqli, $user);

$items = array_merge($items, $homeItems);

$pairs = array_chunk($items, 2);
include_once '../fns/Page/twoColumns.php';
foreach ($items as &$item) {
    if (count($item) == 2) {
        $item = Page\twoColumns($item[0], $item[1]);
    } else {
        $item = $item[0];
    }
}

include_once 'fns/create_new_notifications.php';
include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [],
        'Home',
        Page\sessionMessages('home/messages')
        .create_new_notifications($mysqli, $user)
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel();

include_once '../fns/echo_page.php';
echo_page($user, 'Home', $content, $base);
