<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_events.php';
$user = require_events('../');

include_once "$fnsDir/Users/Events/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Events\deleteAll($mysqli, $user);

unset($_SESSION['calendar/errors']);
$_SESSION['calendar/messages'] = ['All events have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../..');
