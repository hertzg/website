<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../../../fns/Events/deleteOnUser.php';
include_once '../../../lib/mysqli.php';
Events\deleteOnUser($mysqli, $id_users);

include_once '../../../fns/Users/Events/clearNumber.php';
Users\Events\clearNumber($mysqli, $id_users);

unset($_SESSION['calendar/errors']);
$_SESSION['calendar/messages'] = ['All events have been deleted.'];

include_once '../../../fns/redirect.php';
redirect('../..');
