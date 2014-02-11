<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-contact.php';

include_once '../../fns/Contacts/delete.php';
include_once '../../lib/mysqli.php';
Contacts\delete($mysqli, $id);

include_once '../../classes/ContactTags.php';
ContactTags::deleteOnContact($id);

$_SESSION['contacts/index_messages'] = array('Contact has been deleted.');

redirect('..');
