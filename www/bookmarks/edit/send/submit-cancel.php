<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

unset(
    $_SESSION['bookmarks/edit/send/errors'],
    $_SESSION['bookmarks/edit/send/messages']
);

include_once '../../../fns/SendForm/EditItem/submitCancelPage.php';
SendForm\EditItem\submitCancelPage($id, 'bookmarks/edit/send/values');
