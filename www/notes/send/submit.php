<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/send/errors'] = $errors;
    $_SESSION['notes/send/values'] = ['username' => $username];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['notes/send/errors'],
    $_SESSION['notes/send/values']
);

include_once '../../fns/Users/Notes/send.php';
Users\Notes\send($mysqli, $user, $receiver_id_users, $note);

$_SESSION['notes/view/messages'] = ['Sent.'];
redirect("../view/$itemQuery");
