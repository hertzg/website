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

$groupedItems = [];
if (count($items) % 2) $groupedItems[] = array_shift($items);
include_once '../fns/Page/twoColumns.php';
foreach (array_chunk($items, 2) as $item) {
    $groupedItems[] = Page\twoColumns($item[0], $item[1]);
}

include_once 'fns/create_new_notifications.php';
include_once 'fns/create_options_panel.php';
include_once '../fns/Page/tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    Page\tabs(
        [],
        'Home',
        Page\sessionMessages('home/messages')
        .create_new_notifications($mysqli, $user)
        .join('<div class="hr"></div>', $groupedItems)
    )
    .create_options_panel();

include_once '../fns/echo_page.php';
echo_page($user, 'Home', $content, $base);
