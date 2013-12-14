<?php

include_once 'lib/require-user.php';
include_once 'fns/redirect.php';
include_once 'fns/request_strings.php';
include_once 'classes/Bookmarks.php';
include_once 'classes/Channels.php';
include_once 'classes/Contacts.php';
include_once 'classes/Feedbacks.php';
include_once 'classes/Folders.php';
include_once 'classes/Notes.php';
include_once 'classes/Notifications.php';
include_once 'classes/TaskTags.php';
include_once 'classes/Tasks.php';

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

Bookmarks::deleteOnUser($idusers);
Channels::deleteOnUser($idusers);
Contacts::deleteOnUser($idusers);
Feedbacks::deleteOnUser($idusers);
Files::deleteOnUser($idusers);
Folders::deleteOnUser($idusers);
Notes::deleteOnUser($idusers);
Notifications::deleteOnUser($idusers);
TaskTags::deleteOnUser($idusers);
Tasks::deleteOnUser($idusers);
Users::delete($idusers);

$_SESSION['signin_messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 7 * 25 * 60 * 60);
redirect('signin.php');
