<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

if ($username === '') {
    $errors[] = 'Enter text.';
} else {
    include_once '../../fns/Users/getByUsername.php';
    $receiverUser = Users\getByUsername($mysqli, $username);
    if (!$receiverUser) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $receiver_id_users = $receiverUser->id_users;
        if ($receiver_id_users == $id_users) {
            $errors[] = 'You cannot send a note to yourself.';
        } else {
            include_once '../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if (!$connection['can_send_note']) {
                $errors[] = "The user isn't receiving notes from you.";
            }
        }
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/send/errors'] = $errors;
    $_SESSION['notes/send/values'] = ['username' => $username];
    redirect("./?id=$id");
}

include_once '../../fns/ReceivedNotes/add.php';
ReceivedNotes\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $note->text, $note->tags);

$_SESSION['notes/view/messages'] = ['Sent.'];

redirect("../view/?id=$id");
