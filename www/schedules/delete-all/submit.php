<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$id_users = $user->id_users;

include_once '../../fns/Schedules/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Schedules\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/Schedules/clearNumber.php';
Users\Schedules\clearNumber($mysqli, $id_users);

unset($_SESSION['schedules/errors']);
$_SESSION['schedules/messages'] = ['All schedules have been delete.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
