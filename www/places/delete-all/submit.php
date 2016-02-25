<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_places.php';
$user = require_places();

include_once "$fnsDir/Users/Places/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Places\deleteAll($mysqli, $user);

unset($_SESSION['places/errors']);
$_SESSION['places/messages'] = ['All places have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('..');
