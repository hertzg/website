<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset($_SESSION['schedules/view/messages']);

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Schedule #$id",
    "Send Schedule #$id", 'schedule', 'schedules/send/errors',
    'schedules/send/messages', 'schedules/send/values');
