<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-user.php';

include_once '../../classes/Contacts.php';
Contacts::deleteOnUser($idusers);

include_once '../../classes/ContactTags.php';
ContactTags::deleteOnUser($idusers);

$_SESSION['contacts/index_messages'] = array(
    'All contacts have been deleted.',
);

redirect('..');
