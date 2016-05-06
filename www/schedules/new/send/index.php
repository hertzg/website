<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
list($user) = require_stage();

$base = '../../../';

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Schedule', 'schedule', 'schedules/new/send/errors',
    'schedules/new/send/messages', 'schedules/new/send/values',
    $base, "{$base}contacts/");
