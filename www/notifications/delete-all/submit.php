<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Notifications/deleteAllOnUser.php';
include_once '../../lib/mysqli.php';
Notifications\deleteAllOnUser($mysqli, $id_users);

include_once '../../fns/Users/Notifications/clearNumber.php';
Users\Notifications\clearNumber($mysqli, $id_users);

include_once '../../fns/Channels/clearNumNotificationsOnUser.php';
Channels\clearNumNotificationsOnUser($mysqli, $id_users);

include_once '../../fns/SubscribedChannels/clearNumNotificationsOnSubscriber.php';
SubscribedChannels\clearNumNotificationsOnSubscriber($mysqli, $id_users);

unset($_SESSION['notifications/errors']);
$_SESSION['notifications/messages'] = [
    'All notifications have been deleted.',
];

include_once '../../fns/redirect.php';
redirect('..');
