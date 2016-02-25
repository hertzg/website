<?php

include_once '../../../lib/defaults.php';

include_once 'fns/require_computable_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_computable_calculation($mysqli);

unset(
    $_SESSION['calculations/view/errors'],
    $_SESSION['calculations/view/messages']
);

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Calculation #$id",
    "Send Calculation #$id", 'calculation', 'calculations/send/errors',
    'calculations/send/messages', 'calculations/send/values');
