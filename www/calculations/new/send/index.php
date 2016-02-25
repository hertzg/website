<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
list($user) = require_stage();

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Calculation', 'calculation', 'calculations/new/send/errors',
    'calculations/new/send/messages', 'calculations/new/send/values');
