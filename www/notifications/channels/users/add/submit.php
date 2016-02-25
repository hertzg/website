<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../../..');

include_once '../../fns/require_channel.php';
include_once '../../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once "$fnsDir/request_strings.php";
list($subscriber_username) = request_strings('subscriber_username');

include_once "$fnsDir/str_collapse_spaces.php";
$subscriber_username = str_collapse_spaces($subscriber_username);

include_once 'fns/check_username.php';
check_username($mysqli, $id, $user->id_users,
    $subscriber_username, $subscribedChannel, $subscriberUser, $errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/channels/users/add/errors'] = $errors;
    $_SESSION['notifications/channels/users/add/values'] = [
        'subscriber_username' => $subscriber_username,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['notifications/channels/users/add/errors'],
    $_SESSION['notifications/channels/users/add/values']
);

include_once "$fnsDir/Users/Channels/Users/add.php";
Users\Channels\Users\add($mysqli, $user,
    $channel, $subscribedChannel, $subscriberUser);

$_SESSION['notifications/channels/users/messages'] = [
    'The user has been added.',
];

redirect("../?id=$id");
