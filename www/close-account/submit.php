<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';

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

include_once '../classes/Channels.php';
Channels::deleteOnUser($idusers);

include_once '../fns/Contacts/deleteOnUser.php';
Contacts\deleteOnUser($mysqli, $idusers);

include_once '../classes/ContactTags.php';
ContactTags::deleteOnUser($idusers);

include_once '../fns/Events/deleteOnUser.php';
Events\deleteOnUser($mysqli, $idusers);

include_once '../fns/Feedbacks/deleteOnUser.php';
Feedbacks\deleteOnUser($mysqli, $idusers);

include_once '../classes/Files.php';
Files::deleteOnUser($idusers);

include_once '../classes/Folders.php';
Folders::deleteOnUser($idusers);

include_once '../fns/Notes/deleteOnUser.php';
Notes\deleteOnUser($mysqli, $idusers);

include_once '../fns/NoteTags/deleteOnUser.php';
NoteTags\deleteOnUser($mysqli, $idusers);

include_once '../classes/Notifications.php';
Notifications::deleteOnUser($idusers);

include_once '../fns/Tasks/deleteOnUser.php';
Tasks\deleteOnUser($mysqli, $idusers);

include_once '../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $idusers);

include_once '../classes/Tokens.php';
Tokens::deleteOnUser($idusers);

include_once '../classes/Users.php';
Users::delete($idusers);

$_SESSION['sign-in/index_messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 60 * 60 * 24, '/');
redirect('../sign-in/');
