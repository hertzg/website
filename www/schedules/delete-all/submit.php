<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_schedules.php';
$user = require_schedules();

include_once '../../fns/Users/Schedules/deleteAll.php';
include_once '../../lib/mysqli.php';
Users\Schedules\deleteAll($mysqli, $user);

unset($_SESSION['schedules/errors']);
$_SESSION['schedules/messages'] = ['All schedules have been delete.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
