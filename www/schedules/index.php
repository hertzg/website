<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['home/messages']);

include_once '../fns/Schedules/indexOnUser.php';
include_once '../lib/mysqli.php';
$schedules = Schedules\indexOnUser($mysqli, $user->id_users);

$items = [];
if ($schedules) {
} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No schedules');
}

include_once '../fns/create_panel.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Schedules',
    join('<div class="hr"></div>', $items)
    .create_panel(
        'Options',
        Page\imageArrowLink('New Schedule', 'new/', 'TODO')
    )
);

include_once '../fns/echo_page.php';
echo_page($user, 'Schedules', $content, $base);
