<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params($errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/new/errors'] = $errors;
    $_SESSION['notes/new/values'] = [
        'text' => $text,
        'tags' => $tags,
    ];
    redirect();
}

unset(
    $_SESSION['notes/new/errors'],
    $_SESSION['notes/new/values']
);

include_once '../../fns/Users/Notes/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Notes\add($mysqli, $id_users, $text, $tags, $tag_names);

$_SESSION['notes/view/messages'] = ['Note has been saved.'];
redirect("../view/?id=$id");
