<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($password) = request_strings('password');

$errors = array();

if ($password === '') {
    $errors[] = 'Enter password.';
} else {
    include_once '../fns/Password/match.php';
    $hash = $user->password_hash;
    $salt = $user->password_salt;
    if (!Password\match($hash, $salt, $password)) {
        $errors[] = 'Invalid password.';
    }
}

include_once '../fns/redirect.php';

if ($errors) {
    $_SESSION['close-account/errors'] = $errors;
    redirect();
}

unset($_SESSION['close-account/errors']);

include_once '../fns/Bookmarks/deleteOnUser.php';
include_once '../lib/mysqli.php';
Bookmarks\deleteOnUser($mysqli, $idusers);

include_once '../fns/BookmarkTags/deleteOnUser.php';
BookmarkTags\deleteOnUser($mysqli, $idusers);

include_once '../fns/Channels/deleteOnUser.php';
Channels\deleteOnUser($mysqli, $idusers);

include_once '../fns/ChannelUsers/deleteContainingUser.php';
ChannelUsers\deleteContainingUser($mysqli, $idusers);

include_once '../fns/Contacts/deleteOnUser.php';
Contacts\deleteOnUser($mysqli, $idusers);

include_once '../fns/ContactTags/deleteOnUser.php';
ContactTags\deleteOnUser($mysqli, $idusers);

include_once '../fns/Connections/deleteContainingUser.php';
Connections\deleteContainingUser($mysqli, $idusers);

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

$_SESSION['sign-in/messages'] = array(
    'Your account has been closed.',
);

setcookie('username', '', time() - 60 * 60 * 24, '/');
redirect('../sign-in/');
