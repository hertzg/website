<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset($_SESSION['schedule/view/messages']);

include_once '../../fns/Page/imageLink.php';
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
    Page\text('Are you sure you want to delete the schedule?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, delete schedule', "submit.php?id=$id", 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', "../view/?id=$id", 'no')
);

include_once '../../fns/echo_page.php';
echo_page($user, "Delete Schedule #$id", $content, '../../');
