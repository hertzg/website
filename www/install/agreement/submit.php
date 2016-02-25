<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_not_installed.php';
require_not_installed('../');

$_SESSION['install/agreement/accepted'] = true;

include_once "$fnsDir/redirect.php";
redirect('../requirements/');
