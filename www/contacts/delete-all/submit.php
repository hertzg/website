<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_contacts.php';
$user = require_contacts();

include_once "$fnsDir/Users/Contacts/deleteAll.php";
include_once '../../lib/mysqli.php';
Users\Contacts\deleteAll($mysqli, $user);

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = ['All contacts have been deleted.'];

include_once "$fnsDir/redirect.php";
redirect('..');
