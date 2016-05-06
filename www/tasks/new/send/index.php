<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
list($user) = require_stage();

$base = '../../../';

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Task', 'task', 'tasks/new/send/errors',
    'tasks/new/send/messages', 'tasks/new/send/values',
    $base, "{$base}contacts/");
