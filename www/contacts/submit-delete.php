<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-contact.php';
include_once '../classes/Contacts.php';
Contacts::delete($idusers, $id);
$_SESSION['contacts/index_messages'] = array('Contact has been deleted.');
redirect();
