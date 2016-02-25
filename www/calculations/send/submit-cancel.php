<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_computable_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_computable_calculation($mysqli);

unset(
    $_SESSION['calculations/send/errors'],
    $_SESSION['calculations/send/messages']
);

include_once '../../fns/SendForm/submitCancelPage.php';
SendForm\submitCancelPage($id, 'calculations/send/values');
