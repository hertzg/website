<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../../fns/require_user_with_password.php';
$user = require_user_with_password('../../../');

include_once "$fnsDir/request_strings.php";
list($can_send_bookmark, $can_send_calculation, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note,
    $can_send_place, $can_send_schedule, $can_send_task) = request_strings(
    'can_send_bookmark', 'can_send_calculation', 'can_send_channel',
    'can_send_contact', 'can_send_file', 'can_send_note',
    'can_send_place', 'can_send_schedule', 'can_send_task');

$can_send_bookmark = (bool)$can_send_bookmark;
$can_send_calculation = (bool)$can_send_calculation;
$can_send_channel = (bool)$can_send_channel;
$can_send_contact = (bool)$can_send_contact;
$can_send_file = (bool)$can_send_file;
$can_send_note = (bool)$can_send_note;
$can_send_place = (bool)$can_send_place;
$can_send_schedule = (bool)$can_send_schedule;
$can_send_task = (bool)$can_send_task;

include_once "$fnsDir/Users/Account/editAnonymousConnection.php";
include_once '../../../../lib/mysqli.php';
Users\Account\editAnonymousConnection($mysqli, $user,
    $can_send_bookmark, $can_send_calculation, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['account/connections/default/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect('..');
