<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id) = require_contact($mysqli);

include_once '../../fns/Contacts/delete.php';
Contacts\delete($mysqli, $id);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $idusers, -1);

$_SESSION['contacts/index_messages'] = array('Contact has been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
