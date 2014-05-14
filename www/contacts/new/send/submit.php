<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../../fns/Users/getByUsername.php';
    include_once '../../../lib/mysqli.php';
    $receiverUser = Users\getByUsername($mysqli, $username);
    if (!$receiverUser) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $receiver_id_users = $receiverUser->id_users;
        if ($receiver_id_users == $id_users) {
            $errors[] = 'You cannot send a contact to yourself.';
        } else {
            include_once '../../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if (!$connection['can_send_contact']) {
                $errors[] = "The user isn't receiving contacts from you.";
            }
        }
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/new/send/errors'] = $errors;
    $_SESSION['contacts/new/send/values'] = ['username' => $username];
    redirect();
}

unset(
    $_SESSION['contacts/new/values'],
    $_SESSION['contacts/new/send/errors'],
    $_SESSION['contacts/new/send/values']
);

include_once '../../../fns/Users/Contacts/Received/add.php';
Users\Contacts\Received\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $stageValues['full_name'], $stageValues['alias'],
    $stageValues['address'], $stageValues['email'], $stageValues['phone1'],
    $stageValues['phone2'], $stageValues['birthday_time'],
    $stageValues['username'], $stageValues['tags'], $stageValues['favorite']);

$_SESSION['contacts/messages'] = ['Sent.'];
unset($_SESSION['contacts/errors']);

redirect('../..');
