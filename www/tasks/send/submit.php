<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);
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
    $_SESSION['tasks/send/errors'] = $errors;
    $_SESSION['tasks/send/values'] = ['username' => $username];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['tasks/send/errors'],
    $_SESSION['tasks/send/values']
);

include_once '../../fns/Users/Tasks/send.php';
Users\Tasks\send($mysqli, $user, $receiver_id_users, $task);

$_SESSION['tasks/view/messages'] = ['Sent.'];

redirect("../view/$itemQuery");
