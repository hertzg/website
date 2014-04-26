<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once '../../fns/Contacts/delete.php';
Contacts\delete($mysqli, $id);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $user->id_users, -1);

include_once '../../fns/invalidate_user_birthdays.php';
invalidate_user_birthdays($mysqli, $user, $contact->birthday_time);

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = ['Contact has been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
