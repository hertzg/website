<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

include_once '../../../fns/SendForm/EditItem/recipientsPage.php';
SendForm\EditItem\recipientsPage($mysqli, $user, $id, 'Send Edited Calculation',
    'calculation', 'calculations/edit/send/errors',
    'calculations/edit/send/messages', 'calculations/edit/send/values');
