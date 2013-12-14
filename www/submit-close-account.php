<?php

include_once 'lib/require-user.php';
include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';

list($password) = request_strings('password');

$errors = array();

if ($password === '') {
    $errors[] = 'Enter password.';
} elseif ($user->password != md5($password, true)) {
    $errors[] = 'Invalid password.';
}

if ($errors) {
    $_SESSION['close-account_errors'] = $errors;
    redirect('close-account.php');
}

include_once 'classes/BookmarkTags.php';
BookmarkTags::deleteOnUser($idusers);

include_once 'classes/Bookmarks.php';
Bookmarks::deleteOnUser($idusers);

include_once 'classes/Channels.php';
Channels::deleteOnUser($idusers);

include_once 'classes/Contacts.php';
Contacts::deleteOnUser($idusers);

include_once 'classes/Feedbacks.php';
Feedbacks::deleteOnUser($idusers);

include_once 'classes/Files.php';
Files::deleteOnUser($idusers);

include_once 'classes/Folders.php';
Folders::deleteOnUser($idusers);

include_once 'classes/Notes.php';
Notes::deleteOnUser($idusers);

include_once 'classes/Notifications.php';
Notifications::deleteOnUser($idusers);

include_once 'classes/TaskTags.php';
TaskTags::deleteOnUser($idusers);

include_once 'classes/Tasks.php';
Tasks::deleteOnUser($idusers);

include_once 'classes/Users.php';
Users::delete($idusers);

$_SESSION['signin_messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 7 * 25 * 60 * 60);
redirect('signin.php');
