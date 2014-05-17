<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../fns/Users/getByUsername.php';
    $receiverUser = Users\getByUsername($mysqli, $username);
    if (!$receiverUser) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        include_once '../../fns/get_users_connection.php';
        $connection = get_users_connection($mysqli, $receiverUser, $id_users);
        if ($connection['can_send_file']) {
            $receiver_id_users = $receiverUser->id_users;
        } else {
            $errors[] = "The user isn't receiving files from you.";
        }
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/send-file/errors'] = $errors;
    $_SESSION['files/send-file/values'] = ['username' => $username];
    redirect("./?id=$id");
}

unset(
    $_SESSION['files/send-file/errors'],
    $_SESSION['files/send-file/values']
);

include_once '../../fns/Users/Files/send.php';
Users\Files\send($mysqli, $user, $receiver_id_users, $file);

$_SESSION['files/view-file/messages'] = ['Sent.'];

redirect("../view-file/?id=$id");
