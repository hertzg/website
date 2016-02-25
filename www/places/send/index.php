<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

unset($_SESSION['places/view/messages']);

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Place #$id",
    "Send Place #$id", 'place', 'places/send/errors',
    'places/send/messages', 'places/send/values');
