<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_received_places.php';
$user = require_received_places('../');

include_once "$fnsDir/Users/Places/Received/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Places\Received\deleteAll($mysqli, $user);

unset($_SESSION['places/errors']);
$_SESSION['places/messages'] = ['All received places have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('../..');
