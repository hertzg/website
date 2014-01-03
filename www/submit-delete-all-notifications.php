<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();

include_once 'lib/require-user.php';
include_once 'classes/Notifications.php';
Notifications::deleteAll($idusers);

$_SESSION['notifications_messages'] = array('All notifications have been deleted.');

redirect('notifications.php');
