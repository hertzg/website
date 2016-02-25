<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../../lib/mysqli.php';

include_once "$fnsDir/Users/Home/restoreOrder.php";
Users\Home\restoreOrder($mysqli, $id_users);

include_once "$fnsDir/Users/Home/restoreVisibilities.php";
Users\Home\restoreVisibilities($mysqli, $id_users);

$_SESSION['home/customize/messages'] = ['Default home has been restored.'];

include_once "$fnsDir/redirect.php";
redirect('..');
