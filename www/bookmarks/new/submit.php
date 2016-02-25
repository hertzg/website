<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../fns/request_bookmark_params.php';
list($url, $title, $tags,
    $tag_names) = request_bookmark_params($errors, $focus);

$values = [
    'focus' => $focus,
    'title' => $title,
    'url' => $url,
    'tags' => $tags,
];

$_SESSION['bookmarks/new/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['bookmarks/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['bookmarks/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['bookmarks/new/send/bookmark'] = $values;
    unset(
        $_SESSION['bookmarks/new/send/errors'],
        $_SESSION['bookmarks/new/send/messages'],
        $_SESSION['bookmarks/new/send/values']
    );
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['bookmarks/new/values']);

include_once '../../fns/Users/Bookmarks/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Bookmarks\add($mysqli,
    $user->id_users, $url, $title, $tags, $tag_names);

$_SESSION['bookmarks/view/messages'] = ['Bookmark has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
