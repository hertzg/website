<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../fns/Users/Notes/deleteAll.php';
include_once '../../lib/mysqli.php';
Users\Notes\deleteAll($mysqli, $user->id_users);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['All notes have been deleted.'];

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/listUrl.php';
redirect(ItemList\listUrl());
