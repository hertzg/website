<?php

include_once '../../lib/defaults.php';

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Users/BarCharts/editOrderBy.php';
include_once '../lib/mysqli.php';
Users\BarCharts\editOrderBy($mysqli, $user->id_users, 'name, insert_time desc');

unset($_SESSION['bar-charts/errors']);
$_SESSION['bar-charts/messages'] = ['The list is now sorted by name.'];

include_once '../fns/redirect.php';
include_once '../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl('./'));
