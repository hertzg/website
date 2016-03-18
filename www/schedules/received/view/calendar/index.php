<?php

include_once '../../../../../lib/defaults.php';

include_once '../../fns/require_received_schedule.php';
include_once '../../../../lib/mysqli.php';
list($receivedSchedule, $id, $user) = require_received_schedule(
    $mysqli, '../../');

unset($_SESSION['schedules/received/view/messages']);

$fnsDir = '../../../../fns';

include_once '../../../fns/create_calendar.php';
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => "Received Schedule #$id",
        'href' => "../?id=$id#calendar",
    ],
    'Calendar',
    create_calendar($user, $receivedSchedule, $head, '../')
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Received Schedule #$id Calendar",
    $content, '../../../../', ['head' => $head]);
