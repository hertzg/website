<?php

include_once '../../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
    $channelUser = Users\getByUsername($mysqli, $username);
    if (!$channelUser) {
        $errors[] = "A user with the username doesn't exist.";
    } elseif ($channelUser->idusers == $user->idusers) {
        $errors[] = "You don't have to add yourself in the list.";
        $errors[] = 'You will always receive notifications on your channels.';
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['channels/users/add/errors'] = $errors;
    $_SESSION['channels/users/add/values'] = [
        'username' => $username,
    ];
    redirect("./?id=$id");
}

include_once '../../../fns/ChannelUsers/add.php';
$id = ChannelUsers\add($mysqli, $user->idusers, $channelUser->idusers);

redirect("../view/?id=$id");
