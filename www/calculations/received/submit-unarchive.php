<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_calculation.php';
include_once '../../lib/mysqli.php';
list($receivedCalculation, $id, $user) = require_received_calculation($mysqli);

include_once "$fnsDir/Users/Calculations/Received/unarchive.php";
Users\Calculations\Received\unarchive($mysqli, $receivedCalculation);

$message = 'Calculation has been unarchived.';
$_SESSION['calculations/received/view/messages'] = [$message];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
redirect('view/'.ItemList\Received\itemQuery($id));
