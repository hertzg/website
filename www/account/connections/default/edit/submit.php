<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../../../../fns/require_user.php';
$user = require_user('../../../../');

include_once '../../../../fns/request_strings.php';
list($can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task) = request_strings(
    'can_send_bookmark', 'can_send_channel', 'can_send_contact',
    'can_send_file', 'can_send_note', 'can_send_task');

$can_send_bookmark = (bool)$can_send_bookmark;
$can_send_channel = (bool)$can_send_channel;
$can_send_contact = (bool)$can_send_contact;
$can_send_file = (bool)$can_send_file;
$can_send_note = (bool)$can_send_note;
$can_send_task = (bool)$can_send_task;

include_once '../../../../fns/Users/editAnonymousConnection.php';
include_once '../../../../lib/mysqli.php';
Users\editAnonymousConnection($mysqli, $user->id_users, $can_send_bookmark,
    $can_send_channel, $can_send_contact, $can_send_file, $can_send_note,
    $can_send_task);

$message = 'Changes have been saved.';
$_SESSION['account/connections/default/messages'] = [$message];

include_once '../../../../fns/redirect.php';
redirect('..');
