<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/Users/Events/deleteAll.php';
include_once '../../../lib/mysqli.php';
Users\Events\deleteAll($mysqli, $user->id_users);

unset($_SESSION['calendar/errors']);
$_SESSION['calendar/messages'] = ['All events have been deleted.'];

include_once '../../../fns/redirect.php';
redirect('../..');
