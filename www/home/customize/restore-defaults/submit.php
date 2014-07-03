<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../');

include_once '../../../lib/mysqli.php';

include_once '../../../fns/Users/Home/restoreOrder.php';
Users\Home\restoreOrder($mysqli, $user->id_users);

include_once '../../../fns/Users/Home/restoreVisibilities.php';
Users\Home\restoreVisibilities($mysqli, $user->id_users);

$_SESSION['home/customize/messages'] = ['Default home has been restored.'];

include_once '../../../fns/redirect.php';
redirect('..');
