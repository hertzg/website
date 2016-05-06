<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$base = '../../../';

include_once '../../../fns/SendForm/EditItem/recipientsPage.php';
SendForm\EditItem\recipientsPage($mysqli, $user, $id, 'Send Edited Schedule',
    'schedule', 'schedules/edit/send/errors',
    'schedules/edit/send/messages', 'schedules/edit/send/values',
    $base, "{$base}contacts/");
