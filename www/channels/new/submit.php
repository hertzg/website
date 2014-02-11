<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';
include_once '../../fns/request_strings.php';
include_once '../../classes/Channels.php';
include_once '../../lib/mysqli.php';

list($channelname) = request_strings('channelname');

$errors = array();

if ($channelname === '') {
    $errors[] = 'Enter channel name.';
} elseif (preg_match('/[^a-z0-9._-]/ui', $channelname)) {
    $errors[] = 'Channel name contains illegal characters.';
} elseif (strlen($channelname) < 6) {
    $errors[] = 'Channel name too short. At least 6 characters required.';
} elseif (strlen($channelname) > 32) {
    $errors[] = 'Channel name too long. At most 32 characters required.';
} elseif (Channels::getByName($idusers, $channelname)) {
    $errors[] = 'A channel with this name already exists.';
}

if ($errors) {
    $_SESSION['channels/add_errors'] = $errors;
    $_SESSION['channels/add_lastpost'] = array('channelname' => $channelname);
    redirect();
}

unset(
    $_SESSION['channels/add_errors'],
    $_SESSION['channels/add_lastpost']
);

include_once '../../fns/Channels/add.php';
$id = Channels\add($mysqli, $idusers, $channelname);

$_SESSION['channels/view/index_messages'] = array('Channel has been added.');
redirect("../view/?id=$id");
