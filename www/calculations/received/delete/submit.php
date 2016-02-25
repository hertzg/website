<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_calculation.php';
include_once '../../../lib/mysqli.php';
list($receivedCalculation, $id, $user) = require_received_calculation(
    $mysqli, '../');

include_once "$fnsDir/Users/Calculations/Received/delete.php";
Users\Calculations\Received\delete($mysqli, $receivedCalculation);

$messages = ["Received calculation #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if ($user->num_received_calculations == 1) {
    $messages[] = 'No more received calculations.';
    $_SESSION['calculations/messages'] = $messages;
    unset($_SESSION['calculations/errors']);
    redirect('../..');
}

unset($_SESSION['calculations/received/errors']);
$_SESSION['calculations/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
