<?php

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
        $receiver_id_users = $receiverUser->id_users;
        if ($receiver_id_users == $id_users) {
            $errors[] = 'You cannot send a file to yourself.';
        } else {
            include_once '../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if (!$connection['can_send_file']) {
                $errors[] = "The user isn't receiving files from you.";
            }
        }
    }
}

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/send-file/errors'] = $errors;
    $_SESSION['files/send-file/values'] = ['username' => $username];
    redirect("./?id=$id");
}

include_once '../../fns/ReceivedFiles/add.php';
ReceivedFiles\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $file->file_name, $file->file_size, $id);

include_once '../../fns/Users/addNumReceivedFiles.php';
Users\addNumReceivedFiles($mysqli, $receiver_id_users, 1);

$_SESSION['files/view-file/messages'] = ['Sent.'];

redirect("../view-file/?id=$id");
