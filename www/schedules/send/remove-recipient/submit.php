<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($schedule, $id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['schedules/send/errors']);

include_once '../../../fns/SendForm/submitRemovePage.php';
SendForm\submitRemovePage($id, $username,
    'schedules/send/messages', 'schedules/send/values');
