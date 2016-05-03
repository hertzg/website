<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

exec('../../../update.sh');

include_once "$fnsDir/redirect.php";
redirect();
