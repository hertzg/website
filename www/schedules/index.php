<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['home/messages'],
    $_SESSION['schedules/new/errors'],
    $_SESSION['schedules/new/values'],
    $_SESSION['schedules/view/messages']
);

include_once '../fns/Schedules/indexOnUser.php';
include_once '../lib/mysqli.php';
$schedules = Schedules\indexOnUser($mysqli, $user->id_users);

include_once '../fns/Page/imageArrowLink.php';

$items = [];
if ($schedules) {
    foreach ($schedules as $schedule) {
        $title = htmlspecialchars($schedule->text);
        $href = "view/?id=$schedule->id";
        $items[] = Page\imageArrowLink($title, $href, 'TODO');
    }
} else {
    include_once '../fns/Page/info.php';
    $items[] = Page\info('No schedules');
}

include_once '../fns/create_panel.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Schedules',
    Page\sessionErrors('schedules/errors')
    .Page\sessionMessages('schedules/messages')
    .join('<div class="hr"></div>', $items)
    .create_panel(
        'Options',
        Page\imageArrowLink('New Schedule', 'new/', 'TODO')
    )
);

include_once '../fns/echo_page.php';
echo_page($user, 'Schedules', $content, $base);
