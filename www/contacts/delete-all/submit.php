<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Users/Contacts/deleteAll.php';
include_once '../../lib/mysqli.php';
Users\Contacts\deleteAll($mysqli, $user->id_users);

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = ['All contacts have been deleted.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listHref.php';
redirect(ItemList\listHref());
