<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names,
    $encrypt_in_listings) = request_note_params($errors);

$values = [
    'text' => $text,
    'tags' => $tags,
    'encrypt_in_listings' => $encrypt_in_listings,
];

$_SESSION['notes/new/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['notes/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['notes/new/send/note'] = $values;
    unset(
        $_SESSION['notes/new/send/errors'],
        $_SESSION['notes/new/send/messages'],
        $_SESSION['notes/new/send/values']
    );
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['notes/new/values']);

include_once '../../fns/Users/Notes/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Notes\add($mysqli, $user->id_users,
    $text, $tags, $tag_names, $encrypt_in_listings);

$_SESSION['notes/view/messages'] = ['Note has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
