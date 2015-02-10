<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

unset(
    $_SESSION['places/edit/send/errors'],
    $_SESSION['places/edit/send/messages']
);

include_once '../../../fns/SendForm/EditItem/submitCancelPage.php';
SendForm\EditItem\submitCancelPage($id, 'places/edit/send/values');
