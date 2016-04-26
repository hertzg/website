<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../');

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect) = request_note_params($errors, $focus);

$values = [
    'focus' => $focus,
    'text' => $text,
    'tags' => $tags,
    'encrypt_in_listings' => $encrypt_in_listings,
    'password_protect' => $password_protect,
];

$_SESSION['notes/new/values'] = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notes/new/errors'] = $errors;
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['notes/new/errors']);

include_once "$fnsDir/request_strings.php";
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['notes/new/send/note'] = $values;
    unset(
        $_SESSION['notes/new/send/errors'],
        $_SESSION['notes/new/send/messages'],
        $_SESSION['notes/new/send/values']
    );
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('send/'.ItemList\pageQuery());
}

include_once "$fnsDir/Session/EncryptionKey/get.php";
$encryption_key = Session\EncryptionKey\get();

if ($password_protect && $encryption_key === null) {
    $_SESSION['notes/new/lock/note'] = $values;
    unset(
        $_SESSION['notes/new/lock/errors'],
        $_SESSION['notes/new/lock/values']
    );
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('lock/'.ItemList\pageQuery());
}

unset($_SESSION['notes/new/values']);

include_once "$fnsDir/Users/Notes/add.php";
include_once '../../lib/mysqli.php';
$id = Users\Notes\add($mysqli, $user->id_users, $text, $tags,
    $tag_names, $encrypt_in_listings, $password_protect, $encryption_key);

$_SESSION['notes/view/messages'] = ['Note has been saved.'];

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../view/'.ItemList\itemQuery($id));
