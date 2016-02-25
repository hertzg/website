<?php

include_once '../../../../../lib/defaults.php';

$dir = '../../../../';

include_once "$dir/fns/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$dir/fns/require_user.php";
$user = require_user('../../../../');

include_once "$dir/fns/Users/Home/restoreVisibilities.php";
include_once "$dir/lib/mysqli.php";
Users\Home\restoreVisibilities($mysqli, $user->id_users);

$message = 'Default visibilities has been restored.';
$_SESSION['home/customize/show-hide/messages'] = [$message];

include_once "$dir/fns/redirect.php";
redirect('..');
