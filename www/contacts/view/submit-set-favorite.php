<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once '../../fns/Contacts/setFavorite.php';
Contacts\setFavorite($mysqli, $id, true);

include_once '../../fns/ContactTags/setContactFavorite.php';
ContactTags\setContactFavorite($mysqli, $id, true);

$_SESSION['contacts/view/messages'] = ['Marked as favorite.'];

include_once '../../fns/redirect.php';
redirect("./?id=$id");
