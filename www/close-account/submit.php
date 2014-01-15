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
    $_SESSION['close-account_errors'] = $errors;
    redirect();
}

include_once '../classes/Bookmarks.php';
Bookmarks::deleteOnUser($idusers);

include_once '../classes/BookmarkTags.php';
BookmarkTags::deleteOnUser($idusers);

include_once '../classes/Channels.php';
Channels::deleteOnUser($idusers);

include_once '../classes/Contacts.php';
Contacts::deleteOnUser($idusers);

include_once '../classes/ContactTags.php';
ContactTags::deleteOnUser($idusers);

include_once '../classes/Events.php';
Events::deleteOnUser($idusers);

include_once '../classes/Feedbacks.php';
Feedbacks::deleteOnUser($idusers);

include_once '../classes/Files.php';
Files::deleteOnUser($idusers);

include_once '../classes/Folders.php';
Folders::deleteOnUser($idusers);

include_once '../classes/Notes.php';
Notes::deleteOnUser($idusers);

include_once '../classes/NoteTags.php';
NoteTags::deleteOnUser($idusers);

include_once '../classes/Notifications.php';
Notifications::deleteOnUser($idusers);

include_once '../classes/Tasks.php';
Tasks::deleteOnUser($idusers);

include_once '../classes/TaskTags.php';
TaskTags::deleteOnUser($idusers);

include_once '../classes/Tokens.php';
Tokens::deleteOnUser($idusers);

include_once '../classes/Users.php';
Users::delete($idusers);

$_SESSION['sign-in_messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 60 * 60 * 24, '/');
redirect('../sign-in/');
