<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id, $user) = require_bookmark($mysqli);

include_once '../../fns/redirect.php';

$key = 'bookmarks/send/values';
if (!array_key_exists($key, $_SESSION)) redirect('..');

$recipients = $_SESSION[$key]['recipients'];
if (!$recipients) redirect('..');

include_once '../fns/check_receivers.php';
check_receivers($mysqli, $user->id_users,
    $recipients, $receiver_id_userss, $errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

unset($_SESSION['bookmarks/send/messages']);

if ($errors) {
    $_SESSION['bookmarks/send/errors'] = $errors;
    redirect("./$itemQuery");
}

unset(
    $_SESSION['bookmarks/send/errors'],
    $_SESSION['bookmarks/send/values']
);

$_SESSION['bookmarks/view/messages'] = ['Sent.'];

redirect("../view/$itemQuery");
