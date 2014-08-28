<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

$errors = [];

include_once '../fns/request_bookmark_params.php';
list($url, $title, $tags, $tag_names) = request_bookmark_params($errors);

$_SESSION['bookmarks/new/values'] = [
    'title' => $title,
    'url' => $url,
    'tags' => $tags,
];

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
