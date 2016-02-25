<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_points.php';
include_once '../../../lib/mysqli.php';
list($place, $id, $user) = require_points($mysqli, '../');

include_once "$fnsDir/Users/Places/Points/deleteAll.php";
Users\Places\Points\deleteAll($mysqli, $place);

$_SESSION['places/view/messages'] = ['All points have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect("../../view/?id=$id");
