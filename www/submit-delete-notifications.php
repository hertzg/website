<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';
include_once 'fns/request_strings.php';
include_once 'classes/Notifications.php';
list($id) = request_strings('id');
$id = abs((int)$id);
Notifications::deleteOnChannel($idusers, $id);
$_SESSION['notifications_messages'] = array('Notifications have been deleted.');
redirect("notifications.php");
