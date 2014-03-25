<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
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
} else {
    include_once '../../fns/Channels/getByName.php';
    include_once '../../lib/mysqli.php';
    if (Channels\getByName($mysqli, $idusers, $channelname)) {
        $errors[] = 'A channel with this name already exists.';
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['channels/add/index_errors'] = $errors;
    $_SESSION['channels/add/index_values'] = array('channelname' => $channelname);
    redirect();
}

unset(
    $_SESSION['channels/add/index_errors'],
    $_SESSION['channels/add/index_values']
);

include_once '../../fns/Channels/add.php';
$id = Channels\add($mysqli, $idusers, $channelname);

include_once '../../fns/Users/addNumChannels.php';
Users\addNumChannels($mysqli, $idusers, 1);

$_SESSION['channels/view/index_messages'] = array('Channel has been added.');
redirect("../view/?id=$id");
