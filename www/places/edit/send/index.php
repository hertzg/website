<?php

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

include_once '../../../fns/SendForm/EditItem/recipientsPage.php';
SendForm\EditItem\recipientsPage($mysqli, $user, $id, 'Send Edited Place',
    'place', 'places/edit/send/errors',
    'places/edit/send/messages', 'places/edit/send/values');