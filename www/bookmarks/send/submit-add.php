<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$key = 'bookmarks/send/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'recipients' => [],
        'username' => '',
    ];
}

$recipients = &$values['recipients'];

$errors = [];
$messages = [];

if (array_key_exists($username, $recipients)) {
    $messages[] = 'The recipient is already added.';
} else {
    include_once '../fns/check_receiver.php';
    check_receiver($mysqli, $user->id_users,
        $username, $receiver_id_users, $errors);
}

if ($errors) {
    $_SESSION['bookmarks/send/errors'] = $errors;
    $values['username'] = $username;
    unset($_SESSION['bookmarks/send/messages']);
} else {
    unset($_SESSION['bookmarks/send/errors']);
    if (!$messages) {
        $recipients[$username] = $username;
        $messages = ['The recipient has been added.'];
    }
    $_SESSION['bookmarks/send/messages'] = $messages;
}

$_SESSION['bookmarks/send/values'] = $values;

include_once '../../fns/redirect.php';
include_once '../../fns/ItemList/itemQuery.php';
redirect('./'.ItemList\itemQuery($id));
