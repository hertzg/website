<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/Notes/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Notes\deleteOnUser($mysqli, $id_users);

include_once '../../fns/NoteTags/deleteOnUser.php';
NoteTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/clearNumNotes.php';
Users\clearNumNotes($mysqli, $id_users);

unset($_SESSION['notes/errors']);
$_SESSION['notes/messages'] = ['All notes have been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
