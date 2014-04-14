<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($password) = request_strings('password');

$errors = [];

if ($password === '') {
    $errors[] = 'Enter password.';
} else {
    include_once '../../fns/Password/match.php';
    $hash = $user->password_hash;
    $salt = $user->password_salt;
    if (!Password\match($hash, $salt, $password)) {
        $errors[] = 'Invalid password.';
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/close/errors'] = $errors;
    redirect();
}

unset($_SESSION['account/close/errors']);

include_once '../../fns/Bookmarks/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Bookmarks\deleteOnUser($mysqli, $id_users);

include_once '../../fns/BookmarkTags/deleteOnUser.php';
BookmarkTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Channels/deleteOnUser.php';
Channels\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Connections/deleteContainingUser.php';
Connections\deleteContainingUser($mysqli, $id_users);

include_once '../../fns/Contacts/deleteOnUser.php';
Contacts\deleteOnUser($mysqli, $id_users);

include_once '../../fns/ContactTags/deleteOnUser.php';
ContactTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Events/deleteOnUser.php';
Events\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Feedbacks/deleteOnUser.php';
Feedbacks\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Files/deleteOnUser.php';
Files\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Folders/deleteOnUser.php';
Folders\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Notes/deleteOnUser.php';
Notes\deleteOnUser($mysqli, $id_users);

include_once '../../fns/NoteTags/deleteOnUser.php';
NoteTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Notifications/deleteOnUser.php';
Notifications\deleteOnUser($mysqli, $id_users);

include_once '../../fns/ReceivedBookmarks/deleteOnReceiver.php';
ReceivedBookmarks\deleteOnReceiver($mysqli, $id_users);

include_once '../../fns/ReceivedContacts/deleteOnReceiver.php';
ReceivedContacts\deleteOnReceiver($mysqli, $id_users);

include_once '../../fns/ReceivedFiles/deleteOnReceiver.php';
ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

include_once '../../fns/ReceivedNotes/deleteOnReceiver.php';
ReceivedNotes\deleteOnReceiver($mysqli, $id_users);

include_once '../../fns/ReceivedTasks/deleteOnReceiver.php';
ReceivedTasks\deleteOnReceiver($mysqli, $id_users);

include_once '../../fns/SubscribedChannels/deleteContainingUser.php';
SubscribedChannels\deleteContainingUser($mysqli, $id_users);

include_once '../../fns/Tasks/deleteOnUser.php';
Tasks\deleteOnUser($mysqli, $id_users);

include_once '../../fns/TaskTags/deleteOnUser.php';
TaskTags\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Tokens/deleteOnUser.php';
Tokens\deleteOnUser($mysqli, $id_users);

include_once '../../fns/Users/delete.php';
Users\delete($mysqli, $id_users);

$_SESSION['sign-in/messages'] = [
    'Your account has been closed.',
];

setcookie('username', '', time() - 60 * 60 * 24, '/');
redirect('../../sign-in/');
