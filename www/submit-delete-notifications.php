<?php

include_once 'lib/require-user.php';
include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';
include_once 'classes/Notifications.php';
list($idchannels) = request_strings('idchannels');
Notifications::deleteOnChannel($idusers, $idchannels);
$_SESSION['notifications_messages'] = array('Notifications have been deleted.');
redirect("notifications.php?idchannels=$idchannels");
