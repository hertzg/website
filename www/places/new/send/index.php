<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_stage.php';
list($user) = require_stage();

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Place', 'place', 'places/new/send/errors',
    'places/new/send/messages', 'places/new/send/values');
