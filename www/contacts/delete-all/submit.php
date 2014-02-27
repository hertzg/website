<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Contacts/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Contacts\deleteOnUser($mysqli, $idusers);

include_once '../../fns/ContactTags/deleteOnUser.php';
ContactTags\deleteOnUser($mysqli, $idusers);

$_SESSION['contacts/index_messages'] = array(
    'All contacts have been deleted.',
);

include_once '../../fns/redirect.php';
redirect('..');
