<?php

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);
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
            $errors[] = 'You cannot send a task to yourself.';
        } else {
            include_once '../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if (!$connection['can_send_task']) {
                $errors[] = "The user isn't receiving tasks from you.";
            }
        }
    }
}

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['tasks/send/errors'] = $errors;
    $_SESSION['tasks/send/values'] = ['username' => $username];
    redirect("./?$itemQuery");
}

include_once '../../fns/ReceivedTasks/add.php';
ReceivedTasks\add($mysqli, $id_users, $user->username,
    $receiver_id_users, $task->text, $task->top_priority, $task->tags);

include_once '../../fns/Users/addNumReceivedTasks.php';
Users\addNumReceivedTasks($mysqli, $receiver_id_users, 1);

$_SESSION['tasks/view/messages'] = ['Sent.'];

redirect("../view/?$itemQuery");
