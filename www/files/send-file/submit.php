<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $user->id_users,
    $username, $receiver_id_users, $errors);

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
