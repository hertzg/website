<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../../../fns/Channels/request.php';
list($channel_name, $public) = Channels\request();

$errors = [];

if ($channel_name === '') {
    $errors[] = 'Enter channel name.';
} elseif (preg_match('/[^a-z0-9._-]/ui', $channel_name)) {
    $errors[] = 'Channel name contains illegal characters.';
} else {

    $length = strlen($channel_name);

    include_once '../../../fns/ChannelName/minLength.php';
    $minLength = ChannelName\minLength();

    if ($length < $minLength) {
        $errors[] = "Channel name too short. At least $minLength characters required.";
    } else {

        include_once '../../../fns/ChannelName/maxLength.php';
        $maxLength = ChannelName\maxLength();

        if ($length > $maxLength) {
            $errors[] = "Channel name too long. At most $maxLength characters required.";
        } else {
            include_once '../../../fns/Channels/getByName.php';
            include_once '../../../lib/mysqli.php';
            if (Channels\getByName($mysqli, $channel_name)) {
                $errors[] = 'A channel with this name already exists.';
            }
        }

    }

}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notifications/channels/add/errors'] = $errors;
    $_SESSION['notifications/channels/add/values'] = [
        'channel_name' => $channel_name,
        'public' => $public,
    ];
    redirect();
}

unset(
    $_SESSION['notifications/channels/add/errors'],
    $_SESSION['notifications/channels/add/values']
);

include_once '../../../fns/Channels/add.php';
$id = Channels\add($mysqli, $id_users, $user->username, $channel_name, $public);

include_once '../../../fns/Users/Channels/addNumber.php';
Users\Channels\addNumber($mysqli, $id_users, 1);

$_SESSION['notifications/channels/view/messages'] = ['Channel has been added.'];
redirect("../view/?id=$id");
