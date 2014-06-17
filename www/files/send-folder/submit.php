<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $user->id_users,
    $username, $receiver_id_users, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['files/send-folder/errors'] = $errors;
    $_SESSION['files/send-folder/values'] = ['username' => $username];
    redirect("./?id_folders=$id_folders");
}

unset(
    $_SESSION['files/send-folder/errors'],
    $_SESSION['files/send-folder/values']
);

//include_once '../../fns/Users/Folders/send.php';
//Users\Folders\send($mysqli, $user, $receiver_id_users, $folder);

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $id_folders;
$_SESSION['files/messages'] = ['Sent.'];

redirect("../?id_folders=$id_folders");
