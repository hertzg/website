<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt) = request_note_params($errors);

$_SESSION['notes/new/values'] = [
    'text' => $text,
    'tags' => $tags,
];

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/new/errors'] = $errors;
    redirect();
}

unset($_SESSION['notes/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) redirect('send/');

unset($_SESSION['notes/new/values']);

include_once '../../fns/Users/Notes/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Notes\add($mysqli, $id_users, $text, $tags, $tag_names, $encrypt);

$_SESSION['notes/view/messages'] = ['Note has been saved.'];
redirect("../view/?id=$id");
