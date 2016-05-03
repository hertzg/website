<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

exec('git fetch');

include_once "$fnsDir/redirect.php";
redirect();
