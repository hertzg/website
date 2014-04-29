<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset(
    $_SESSION['schedules/errors'],
    $_SESSION['schedules/messages']
);

include_once '../../fns/create_panel.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Schedules',
            'href' => '..',
        ],
    ],
    "Schedule #$id",
    Page\sessionMessages('schedules/view/messages')
    .Page\text(htmlspecialchars($schedule->text))
    .create_panel(
        'Schedule Options',
        Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, "Schedule #$id", $content, '../../');
