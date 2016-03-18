<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_schedule.php';
include_once '../../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli, '../');

unset($_SESSION['schedules/view/messages']);

$fnsDir = '../../../fns';

include_once '../../fns/create_calendar.php';
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => "Schedule #$id",
        'href' => "../?id=$id#calendar",
    ],
    'Calendar',
    create_calendar($user, $schedule, $head)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Schedule #$id Calendar",
    $content, '../../../', ['head' => $head]);
