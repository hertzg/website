<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../../..');

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['calculations/edit/send/errors']);

include_once "$fnsDir/SendForm/EditItem/submitRemovePage.php";
SendForm\EditItem\submitRemovePage($id, $username,
    'calculations/edit/send/messages', 'calculations/edit/send/values');
