<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Contacts/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Contacts\deleteOnUser($mysqli, $id_users);

include_once '../../fns/ContactTags/deleteOnUser.php';
ContactTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/clearNumContacts.php';
Users\clearNumContacts($mysqli, $id_users);

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = [
    'All contacts have been deleted.',
];

include_once '../../fns/redirect.php';
redirect('..');
