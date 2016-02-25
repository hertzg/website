<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_requirements.php';
require_requirements();

include_once "$fnsDir/redirect.php";
redirect('../general-info/');
