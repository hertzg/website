<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../../fns/require_user.php';
$user = require_user('../../../../');

include_once '../../../../fns/Users/Home/restoreVisibilities.php';
include_once '../../../../lib/mysqli.php';
Users\Home\restoreVisibilities($mysqli, $user->id_users);

$message = 'Default visibilities has been restored.';
$_SESSION['home/customize/show-hide/messages'] = [$message];

include_once '../../../../fns/redirect.php';
redirect('..');
