<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once 'fns/require_recipient.php';
list($username, $user) = require_recipient();

unset($_SESSION['calculations/new/send/errors']);

include_once "$fnsDir/SendForm/NewItem/submitRemovePage.php";
SendForm\NewItem\submitRemovePage($username,
    'calculations/new/send/messages', 'calculations/new/send/values');
