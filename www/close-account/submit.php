<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect();

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/request_strings.php';
list($password) = request_strings('password');

$errors = array();

if ($password === '') {
    $errors[] = 'Enter password.';
} elseif ($user->password != md5($password, true)) {
    $errors[] = 'Invalid password.';
}

if ($errors) {
    $_SESSION['close-account/index_errors'] = $errors;
    redirect();
}

unset($_SESSION['close-account/index_errors']);

include_once '../fns/Bookmarks/deleteOnUser.php';
include_once '../lib/mysqli.php';
Bookmarks\deleteOnUser($mysqli, $idusers);

include_once '../fns/BookmarkTags/deleteOnUser.php';
BookmarkTags\deleteOnUser($mysqli, $idusers);

include_once '../fns/Channels/deleteOnUser.php';
Channels\deleteOnUser($mysqli, $idusers);

include_once '../fns/Contacts/deleteOnUser.php';
Contacts\deleteOnUser($mysqli, $idusers);

include_once '../fns/ContactTags/deleteOnUser.php';
ContactTags\deleteOnUser($mysqli, $idusers);

include_once '../fns/Events/deleteOnUser.php';
Events\deleteOnUser($mysqli, $idusers);

include_once '../fns/Feedbacks/deleteOnUser.php';
Feedbacks\deleteOnUser($mysqli, $idusers);

include_once '../fns/Files/deleteOnUser.php';
Files\deleteOnUser($mysqli, $idusers);

include_once '../fns/Folders/deleteOnUser.php';
Folders\deleteOnUser($mysqli, $idusers);

include_once '../fns/Notes/deleteOnUser.php';
Notes\deleteOnUser($mysqli, $idusers);

include_once '../fns/NoteTags/deleteOnUser.php';
NoteTags\deleteOnUser($mysqli, $idusers);

include_once '../fns/Notifications/deleteOnUser.php';
Notifications\deleteOnUser($mysqli, $idusers);

include_once '../fns/Tasks/deleteOnUser.php';
Tasks\deleteOnUser($mysqli, $idusers);

include_once '../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $idusers);

include_once '../fns/Tokens/deleteOnUser.php';
Tokens\deleteOnUser($mysqli, $idusers);

include_once '../fns/Users/delete.php';
Users\delete($mysqli, $idusers);

$_SESSION['sign-in/index_messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 60 * 60 * 24, '/');
redirect('../sign-in/');
