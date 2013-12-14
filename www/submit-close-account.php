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

Bookmarks::deleteUser($idusers);
Channels::deleteUser($idusers);
Contacts::deleteUser($idusers);
Feedbacks::deleteUser($idusers);
Files::deleteUser($idusers);
Folders::deleteUser($idusers);
Notes::deleteUser($idusers);
Notifications::deleteUser($idusers);
TaskTags::deleteOnUser($idusers);
Tasks::deleteUser($idusers);
Users::delete($idusers);

$_SESSION['signin_messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 7 * 25 * 60 * 60);
redirect('signin.php');
