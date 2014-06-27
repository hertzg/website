<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

include_once '../../fns/Users/Schedules/delete.php';
Users\Schedules\delete($mysqli, $user, $schedule);

$_SESSION['schedules/messages'] = ['Schedule has been deleted.'];
unset($_SESSION['schedules/errors']);

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
